<?php

namespace Lrs\Tracker\Http\Middleware;

use Lrs\Tracker\Models\Site;
use Closure;
use Illuminate\Support\Facades\Redirect;

class CreateLRS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $site       = Site::first();
        $allowed    = $site->create_lrs;
        $user_role  = \Auth::user()->role;

        if( !in_array($user_role, $allowed) ){
            return Redirect::to('/');
        }
        return $next($request);
    }
}
