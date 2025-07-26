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
                Forms\Components\Select::make('category')
                    ->options([
                        'service' => 'Service',
                        'billing' => 'Billing',
                        'product' => 'Product',
                        'other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in-progress' => 'In Progress',
                        'resolved' => 'Resolved',
                    ])
                    ->required(),
                Forms\Components\KeyValue::make('ai_analysis')
                    ->label('AI Analysis')
                    ->disabled(), // Display AI results (read-only)
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('ai_analysis.sentiment')
                    ->label('Sentiment'),
                Tables\Columns\TextColumn::make('ai_analysis.urgency')
                    ->label('Urgency'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
