<?php

namespace App\Filament\Resources\Student\CourseResource\Pages;

use App\Filament\Resources\Student\CourseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
