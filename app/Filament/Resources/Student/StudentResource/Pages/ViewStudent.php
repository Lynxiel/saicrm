<?php

namespace App\Filament\Resources\Student\StudentResource\Pages;

use App\Filament\Resources\Student\StudentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
