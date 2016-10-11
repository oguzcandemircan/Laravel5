<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Auth;
use View;

class SessionController extends Controller{

    public function create(){

        if (Auth::check()) return Redirect::to('/admin');
        return View::make("session.create");
    }
    public function store(){
        if(Auth::attempt(Input::only('username', 'password')))
        {
            return "Hoş Geldin ".Auth::user()->username;
        }

        return Redirect::back()->withInput();
    }
     public function destroy(){
        Auth::logout();
        return Redirect::route('sessions.create');
    }
}