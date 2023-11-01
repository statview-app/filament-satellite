<?php

use Statview\FilamentSatellite\Http\Controllers\DiscoverController;

Route::group([
    'prefix' => 'statview/satellite/filament',
], function () {
    Route::get('ping', fn () => 'pong');

    Route::get('discover', DiscoverController::class);
});
