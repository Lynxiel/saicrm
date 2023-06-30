<?php

namespace Settings;

use Spatie\LaravelSettings\Settings;

class SettingName extends Settings
{

    public static function group(): string
    {
        return 'General';
    }
}