<?php

namespace App\Filament\Resources\Student\CourseStudentResource\Pages;

use App\Filament\Resources\Student\CourseStudentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCourseStudents extends ManageRecords
{
    protected static string $resource = CourseStudentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


}
