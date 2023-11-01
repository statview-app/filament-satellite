<?php

namespace Statview\FilamentSatellite\Concerns;

trait HasAnnouncements
{
    public bool $announcementsEnabled = true;

    public function announcements(bool $flag = true): static
    {
        $this->announcementsEnabled = $flag;

        return $this;
    }

    public function getAnnouncementsEnabled(): bool
    {
        return $this->announcementsEnabled;
    }
}