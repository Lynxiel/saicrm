<?php

namespace App\Filament\Resources\Student\CourseResource\Pages;

use App\Filament\Resources\Student\CourseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
