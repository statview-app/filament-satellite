<?php

use Filament\Facades\Filament;
use Statview\FilamentSatellite\Http\Middleware\ValidateKey;
use Statview\FilamentSatellite\SatellitePlugin;
use Illuminate\Support\Facades\Auth;

Route::group([
    'prefix' => 'statview/satellite/filament/auth',
    'middleware' => ValidateKey::class,
], function () {

    Route::get('one-click-login', function () {
        $plugin = Filament::getDefaultPanel()
            ->getPlugin(id: SatellitePlugin::$id);

        $user = $plugin->getOneClickLoginUser();

        Auth::login($user);

        return redirect($plugin->getOneClickLoginRedirect());
    });

});
