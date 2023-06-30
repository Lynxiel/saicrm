<?php

namespace App\Filament\Resources\Student\CourseResource\Pages;

use App\Filament\Resources\Student\CourseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;


    protected function getHeaderWidgets(): array
    {
        return CourseResource::getWidgets();
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
