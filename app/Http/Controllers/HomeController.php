<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    public function index()
    {
        $user = Auth::user();

        if($user){
            return view('home', []);
        } else {
            return view('home');
        }
    }
}