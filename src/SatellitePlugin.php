<?php

namespace Statview\FilamentSatellite;

use Illuminate\Support\HtmlString;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Support\Facades\Blade;
use Statview\FilamentSatellite\Concerns\HasAnnouncements;
use Statview\FilamentSatellite\Concerns\HasOneClickLogin;

class SatellitePlugin implements Plugin
{
    use HasOneClickLogin,
        HasAnnouncements,
        EvaluatesClosures;

    public static string $id = 'statview-satellite';

    public function getId(): string
    {
        return static::$id;
    }

    public function register(Panel $panel): void
    {
        if ($this->getAnnouncementsEnabled()) {
            $panel->renderHook('panels::content.start', fn () => new HtmlString(Blade::render("@livewire('filament-satellite::announcements')")));
        }
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }
}