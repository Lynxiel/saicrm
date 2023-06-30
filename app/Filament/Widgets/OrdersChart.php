<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class OrdersChart extends LineChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Students per month';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => [2433, 3454, 4566, 2342, 5545, 5765, 6787, 8767, 7565, 8576, 9686, 8996],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
