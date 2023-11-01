<?php

namespace Statview\FilamentSatellite\Concerns;

use Closure;
use Filament\Models\Contracts\FilamentUser;

trait HasOneClickLogin
{
    public ?Closure $oneClickLoginUser = null;

    public null|Closure|string $oneClickLoginRedirect = null;

    public function oneClickLogin(Closure $user, null|Closure|string $redirect): static
    {
        $this->oneClickLoginUser = $user;
        $this->oneClickLoginRedirect = $redirect;

        return $this;
    }

    public function getOneClickLoginEnabled(): bool
    {
        return filled($this->oneClickLoginUser) && filled($this->oneClickLoginRedirect);
    }

    public function getOneClickLoginUser(): FilamentUser
    {
        return $this->evaluate($this->oneClickLoginUser);
    }

    public function getOneClickLoginRedirect()
    {
        return $this->evaluate($this->oneClickLoginRedirect);
    }
}
