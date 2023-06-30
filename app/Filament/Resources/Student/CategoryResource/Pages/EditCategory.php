<?php

namespace App\Filament\Resources\Student\CategoryResource\Pages;

use App\Filament\Resources\Student\CategoryResource;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    use HasPageShield;

    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
