<?php

namespace App\Filament\Resources\Student\CategoryResource\Pages;

use App\Filament\Resources\Student\CategoryResource;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategory extends ViewRecord
{
    use HasPageShield;
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
