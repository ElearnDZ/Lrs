<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;

class RegistrationStatusAuthenticete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $site = Site::first();
        if ($site) {
            if ($site->registration != 'Open') return Redirect::to('/');
        }
        return $next($request);
    }
}
