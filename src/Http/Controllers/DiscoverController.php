<?php

namespace Statview\FilamentSatellite\Http\Controllers;

use Filament\Facades\Filament;
use Illuminate\Routing\Controller;
use Statview\FilamentSatellite\SatellitePlugin;

class DiscoverController extends Controller
{
    public function __invoke()
    {
        try {
            $plugin = Filament::getDefaultPanel()
                ->getPlugin(SatellitePlugin::$id);

            return [
                'one_click_login' => $plugin->getOneClickLoginEnabled(),
                'announcements' => $plugin->getAnnouncementsEnabled(),
            ];
        } catch (\Exception $exception) {
            return [];
        }
    }
}