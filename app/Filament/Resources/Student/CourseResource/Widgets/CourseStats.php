<?php

namespace App\Filament\Resources\Student\CourseResource\Widgets;

use App\Models\Student\Course;
use App\Models\Student\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CourseStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Всего курсов ', Course::count()),
            Card::make('Всего категорий ', Category::count()),
            Card::make('Последний курс', Course::orderBy('created_at','desc')->limit(1)->get()->toArray()[0]['name']?? ''  ),
        ];
    }
}
