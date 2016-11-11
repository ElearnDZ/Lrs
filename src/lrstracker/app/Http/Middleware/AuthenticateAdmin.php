<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class AuthenticateAdmin
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
        $lrs      = Lrs::find( $request->route()->parameter('lrs') );
        $user     = \Auth::user()->_id;
        $is_admin = false;
        foreach( $lrs->users as $u ){
            //is the user on the LRS user list with role admin?
            if($u['user'] == $user && $u['role'] == 'admin'){
                $is_admin = true;
            }
        }
        if( !$is_admin ){
            return Redirect::to('/');
        }

        return $next($request);
    }
}
