<?php

namespace App\Filament\Resources\Student\StudentResource\Pages;

use App\Filament\Resources\Student\StudentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = StudentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
