<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
class CustomersChart extends LineChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Total students';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => [4344, 5676, 6798, 7890, 8987, 9388, 10343, 10524, 13664, 14345, 15753],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
