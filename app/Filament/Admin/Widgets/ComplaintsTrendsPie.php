<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Complaint;
use Filament\Widgets\ChartWidget;

class ComplaintsTrendsPie extends ChartWidget
{
    protected static ?string $heading = 'Complaints by Priority (Last 30 days)';

    protected function getData(): array
    {
        $since = now()->subDays(30);
        $q = Complaint::query()->where('created_at', '>=', $since);

        $counts = [
            'high' => (clone $q)->where('priority', 'high')->count(),
            'medium' => (clone $q)->where('priority', 'medium')->count(),
            'low' => (clone $q)->where('priority', 'low')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Priority Split',
                    'data' => array_values($counts),
                    'backgroundColor' => ['#ef4444', '#f59e0b', '#10b981'],
                ],
            ],
            'labels' => ['High', 'Medium', 'Low'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
