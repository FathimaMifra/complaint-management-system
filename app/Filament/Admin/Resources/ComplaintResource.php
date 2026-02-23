<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ComplaintResource\Pages;
use App\Filament\Admin\Resources\ComplaintResource\RelationManagers;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\ListRecords;
use App\Services\AiAnalysisService;
use Illuminate\Support\Carbon;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in-progress' => 'In Progress',
                        'resolved' => 'Resolved',
                    ])
                    ->required(),
                Forms\Components\Select::make('sentiment')
                    ->options([
                        'negative' => 'Negative',
                        'neutral' => 'Neutral',
                        'positive' => 'Positive',
                    ])
                    ->default('neutral'),
                Forms\Components\Select::make('priority')
                    ->options([
                        'high' => 'High',
                        'medium' => 'Medium',
                        'low' => 'Low',
                    ])
                    ->default('medium'),
                // Admin Notes stored in ai_analysis JSON
                Forms\Components\Textarea::make('ai_analysis.admin_notes')
                    ->label('Admin Notes')
                    ->rows(3)
                    ->helperText('Internal notes (not visible to users).'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(60)
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->label('Priority')
                    ->color(fn (string $state) => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('sentiment')
                    ->badge()
                    ->label('Sentiment')
                    ->color(fn (string $state) => match ($state) {
                        'negative' => 'danger',
                        'neutral' => 'warning',
                        'positive' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'in-progress' => 'info',
                        'resolved' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->label('Created')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('Y-m-d H:i')
                    ->label('Updated')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'high' => 'High',
                        'medium' => 'Medium',
                        'low' => 'Low',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in-progress' => 'In Progress',
                        'resolved' => 'Resolved',
                    ]),
                Tables\Filters\Filter::make('created_between')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Created From'),
                        Forms\Components\DatePicker::make('created_until')->label('Created Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'] ?? null, fn (Builder $q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'] ?? null, fn (Builder $q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Predict')
                        ->action(function ($record) {
                            $aiService = app(AiAnalysisService::class);
                            $result = $aiService->analyze($record->description);

                            if (!isset($result['error'])) {
                                $currentAnalysis = $record->ai_analysis ? (is_array($record->ai_analysis) ? $record->ai_analysis : json_decode($record->ai_analysis, true)) : [];
                                $newAnalysis = json_decode(json_encode($result), true);

                                $record->sentiment = $newAnalysis['sentiment'] ?? $currentAnalysis['sentiment'] ?? 'neutral';
                                $record->priority = $newAnalysis['urgency'] ?? $currentAnalysis['urgency'] ?? 'medium';

                                $record->ai_analysis = $newAnalysis;
                                $record->save();
                                \Filament\Notifications\Notification::make()
                                    ->title('AI Prediction Successful')
                                    ->body('Analysis updated.')
                                    ->success()
                                    ->send();
                            } else {
                                \Filament\Notifications\Notification::make()
                                    ->title('AI Prediction Failed')
                                    ->body($result['error'])
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->label('Predict')
                        ->color('success')
                        ->icon('heroicon-o-cpu-chip'),

                    Tables\Actions\Action::make('edit_status_notes')
                        ->label('Edit Status & Notes')
                        ->icon('heroicon-o-pencil-square')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'pending' => 'Pending',
                                    'in-progress' => 'In Progress',
                                    'resolved' => 'Resolved',
                                ])
                                ->required(),
                            Forms\Components\Textarea::make('admin_notes')
                                ->label('Admin Notes')
                                ->rows(4),
                        ])
                        ->action(function (array $data, Complaint $record) {
                            $record->status = $data['status'];

                            // Persist admin notes into ai_analysis JSON under 'admin_notes'
                            $analysis = $record->ai_analysis;
                            if (!is_array($analysis)) {
                                $analysis = json_decode($analysis ?? '{}', true) ?: [];
                            }
                            if (filled($data['admin_notes'] ?? null)) {
                                $analysis['admin_notes'] = $data['admin_notes'];
                            }
                            $record->ai_analysis = $analysis;
                            $record->save();

                            \Filament\Notifications\Notification::make()
                                ->title('Updated')
                                ->body('Status and notes saved successfully.')
                                ->success()
                                ->send();
                        }),
                    //Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-o-ellipsis-vertical')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}
