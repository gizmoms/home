<?php namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {

    public function __construct()
    {
        //
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        if((Input::get('name') == '') || (Input::get('password') == ''))
        {
            Session::flash('error', 'Benutzer oder Passwort dürfen nicht leer sein!');
            return Redirect::to('/');
        } else {
            $user = User::where('name', strtoupper(Input::get('name')))->first();
            if($user != null)
            {
                if(Auth::attempt(['name' => Input::get('name'), 'password' => Input::get('password')]))
                {
                    Auth::login( $user );
                    return Redirect::to('/');
                } else {
                    Session::flash('error', 'Benutzer oder Passwort ist falsch!');
                    return Redirect::to('/');
                }
            } else {
                Session::flash('error', 'Benutzer existiert nicht!');
                return Redirect::to('/');
            }
        }
    }

    public function logout()
    {
        if ( ! Auth::guest())
        {
            Auth::logout();
            return Redirect::to('/');
        }
        return Redirect::to('/');
    }
}
