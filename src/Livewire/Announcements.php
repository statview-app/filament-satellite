<?php

namespace Statview\FilamentSatellite\Livewire;

use Filament\Notifications\Notification;
use Livewire\Component;
use Statview\Satellite\Statview;
use Livewire\Attributes\On;

class Announcements extends Component
{
    protected static $cacheKey = 'statview_announcements';

    public function getAnnouncements()
    {
        $announcements = cache()
            ->remember(static::$cacheKey, 5, function () {
                return Statview::getAnnouncements();
            });

        if (! filled($announcements)) {
            return;
        }

        foreach ($announcements as $announcement) {
            if (session()->get(static::getAnnouncementSessionKey($announcement['id']))) {
                continue;
            }

            $this->generateNotification(
                announcement: $announcement
            );
        }
    }

    #[On('notification-closed')]
    public function closed($id): void
    {
        if (! str($id)->startsWith('statview-announcement-')) {
            return;
        }

        $id = str($id)->replace('statview-announcement-', '')->toString();

        session()->put(static::getAnnouncementSessionKey($id), true);
    }

    protected function generateNotification(array $announcement)
    {
        $notification = Notification::make()
            ->title($announcement['title'])
            ->body($announcement['body'])
            ->id('statview-announcement-' . $announcement['id']);

        if ($announcement['duration'] === 'persistent') {
            $notification->persistent();
        }

        $notification->{$announcement['type']}();

        $notification->send();
    }

    public static function getAnnouncementSessionKey($id): string
    {
        return "notified_statview_announcement_" . $id;
    }

    public function render()
    {
        return view('filament-satellite::livewire.announcements');
    }
}