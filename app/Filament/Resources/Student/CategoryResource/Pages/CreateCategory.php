<?php

namespace App\Filament\Resources\Student\CategoryResource\Pages;

use App\Filament\Resources\Student\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class CreateCategory extends CreateRecord
{
    use HasPageShield;

    protected static string $resource = CategoryResource::class;
}
