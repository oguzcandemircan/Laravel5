<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class KullaniciController  extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    function denemeControl()
    {
        return view('deneme')->with('a','string ifade');
    }
     public function kullaniciEkle(){
        $user = new User();
        $user->username = Input::get('kullaniciAdi');
        $user->password = Hash::make(Input::get('sifre'));
        $kaydet = $user->save();
        if($kaydet){
            return 'Kaydedildi';
        }else{
            return 'Kaydedilemedi';
        }
    }

    

}
