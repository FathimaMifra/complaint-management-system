<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Complaint;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ComplaintsStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';

    protected function getCards(): array
    {
        $resolved = Complaint::query()->where('status', 'resolved')->get();
        $avgHours = null;
        if ($resolved->count() > 0) {
            $total = 0;
            foreach ($resolved as $c) {
                $total += $c->created_at?->diffInHours($c->updated_at ?? now()) ?? 0;
            }
            $avgHours = round($total / max($resolved->count(), 1), 1);
        }

        $openComplaints = Complaint::whereIn('status', ['pending', 'in-progress'])->count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        $totalUsers = User::count();

        return [
            //Card::make('Avg Resolution Time', $avgHours !== null ? $avgHours . 'h' : 'N/A')
             //   ->description('Average time from created to resolved')
              //  ->descriptionIcon('heroicon-m-clock')
              //  ->color('info'),
            Card::make('Open Complaints', (string) $openComplaints)
                ->description('Pending + In Progress')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),
            Card::make('Resolved', (string) $resolvedComplaints)
                ->description('Total resolved complaints')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Card::make('Total Users', (string) $totalUsers)
                ->description('All registered users in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),    
        ];
    }
}
