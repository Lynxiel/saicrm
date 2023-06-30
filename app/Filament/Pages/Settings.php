<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Settings\GeneralSettings;
use Filament\Forms;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;

class Settings extends SettingsPage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GeneralSettings::class;
    protected static ?string $navigationGroup = 'Filament shield';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('site_name')
                ->label('Site name')
                ->required(),
           Checkbox::make('site_active')
            ->label('Site active')
        ];
    }
}
