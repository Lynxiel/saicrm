<?php

namespace App\Filament\Resources\Student\StudentResource\Pages;

use App\Filament\Resources\Student\StudentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;
}
