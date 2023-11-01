<?php

namespace Statview\FilamentSatellite;

use Filament\Support\Facades\FilamentAsset;
use Livewire;
use Illuminate\Support\ServiceProvider;
use Statview\FilamentSatellite\Livewire\Announcements;

class FilamentSatelliteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/auth.php');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/components', 'filament-satellite');

        Livewire::component('filament-satellite::announcements', Announcements::class);
    }
}