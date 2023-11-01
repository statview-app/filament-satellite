<?php

namespace Statview\FilamentSatellite\Http\Middleware;

use Closure;
use Statview\FilamentSatellite\Exceptions\StatviewKeyNotFoundInRequest;
use Statview\FilamentSatellite\Exceptions\StatviewStampNotFoundInRequest;

class ValidateKey
{
    public function handle($request, Closure $next)
    {
        $key = request()->input('key');
        $stamp = request()->input('stamp');

        if (! filled($key)) {
            throw new StatviewKeyNotFoundInRequest();
        }

        if (! filled($stamp)) {
            throw new StatviewStampNotFoundInRequest();
        }

        $this->validateStamp($stamp);
        $this->validateKey($stamp, $key);

        return $next($request);
    }

    protected static function validateStamp($stamp): void
    {
        $valid = ($stamp > time() - 360) && ($stamp < time() + 360);

        abort_unless($valid, 403, 'Invalid stamp');
    }

    protected static function validateKey($stamp, $key): void
    {
        $valid = false;

        $generatedSignature = hash_hmac('sha256', $stamp, config('statview.api_key'));

        if ($generatedSignature === $key) {
            $valid = true;
        }

        abort_unless($valid, 403, 'Invalid key');
    }
}