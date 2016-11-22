<?php

namespace Lrs\Tracker\Http\Middleware;

use Lrs\Tracker\Locker\Helpers\Access;
use Closure;

class UserDelete
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
        $user = $request->route()->parameter('users');
        if( \Auth::user()->_id != $user && ! Access::isRole('super') ){
            return Redirect::to('/');
        }
        return $next($request);
    }
}
