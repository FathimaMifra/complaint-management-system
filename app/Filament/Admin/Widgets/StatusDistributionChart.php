<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Complaint;
use Filament\Widgets\ChartWidget;

class StatusDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Status Distribution';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $counts = [
            'pending' => Complaint::where('status', 'pending')->count(),
            'in-progress' => Complaint::where('status', 'in-progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Status Distribution',
                    'data' => array_values($counts),
                    'backgroundColor' => [
                        '#f59e0b', // warning for pending
                        '#3b82f6', // info for in-progress
                        '#10b981', // success for resolved
                    ],
                ],
            ],
            'labels' => ['Pending', 'In Progress', 'Resolved'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

