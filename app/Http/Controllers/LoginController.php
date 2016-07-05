<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class LoginController extends BaseController
{


    /**
     * Show the form for creating a new Session
     */
    public function create()
    {
        return view('system.forms.login');
    }

    public function login()
    {

        $creds = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        $remember_me = Input::get('remember', 0);

        if (Auth::attempt($creds, $remember_me)) {
            return Redirect::intended('/');
        }

        return Redirect::route('login.create')
            ->withInput()
            ->withErrors(array('There is a problem with those credentials.'));

    }

    /**
     * Logout
     **/
    public function destroy()
    {
        Auth::logout();
        return Redirect::to('/');
    }

}