<?php

namespace App\Filament\Admin\Pages;

use App\Models\Complaint;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;

class ComplaintsCalendar extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.admin.pages.complaints-calendar';

    protected static ?string $navigationLabel = 'Resolution Calendar';

    protected static ?string $title = 'Complaints Resolution Calendar';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?int $navigationSort = 10;

    public string $viewMode = 'week'; // 'day' or 'week'

    public function mount(): void
    {
        //
    }


    #[Computed]
    public function complaints()
    {
        return $this->getComplaints();
    }

    public function getComplaints()
    {
        $startDate = request()->get('start', now()->startOfWeek());
        $endDate = request()->get('end', now()->endOfWeek());

        if ($this->viewMode === 'day') {
            $date = Carbon::parse($startDate ?: now());
            $startDate = $date->startOfDay();
            $endDate = $date->copy()->endOfDay();
        } else {
            $startDate = Carbon::parse($startDate ?: now())->startOfWeek();
            $endDate = Carbon::parse($endDate ?: now())->endOfWeek();
        }

        return Complaint::where(function ($query) use ($startDate, $endDate) {
            // Complaints with due dates in range
            $query->where(function ($q) use ($startDate, $endDate) {
                $q->whereNotNull('due_date')
                  ->whereDate('due_date', '>=', $startDate)
                  ->whereDate('due_date', '<=', $endDate);
            })
                // Or complaints resolved in range
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('status', 'resolved')
                      ->whereDate('updated_at', '>=', $startDate)
                      ->whereDate('updated_at', '<=', $endDate);
                })
                // Or active complaints created in range
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->whereIn('status', ['pending', 'in-progress'])
                      ->whereDate('created_at', '>=', $startDate)
                      ->whereDate('created_at', '<=', $endDate);
                });
        })
        ->with('user')
        ->get()
        ->map(function ($complaint) {
            $date = $complaint->due_date 
                ? Carbon::parse($complaint->due_date)
                : ($complaint->status === 'resolved' 
                    ? Carbon::parse($complaint->updated_at)
                    : Carbon::parse($complaint->created_at));

            return [
                'id' => $complaint->id,
                'title' => $complaint->title,
                'date' => $date->format('Y-m-d'),
                'status' => $complaint->status,
                'priority' => $complaint->priority,
                'user' => $complaint->user->name ?? 'Unknown',
                'url' => route('filament.admin.resources.complaints.edit', $complaint->id),
            ];
        });
    }
}

