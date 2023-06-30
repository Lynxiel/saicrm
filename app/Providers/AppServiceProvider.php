<?php

namespace App\Providers;

use App\Filament\Resources\Student\CategoryResource;
use App\Filament\Resources\Student\CourseResource;
use App\Filament\Resources\Student\StudentResource;
use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationBuilder;
use BezhanSalleh\FilamentShield\Resources\RoleResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
