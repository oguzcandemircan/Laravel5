<?php

namespace App\Http\Controllers;
 

// Kullanmak istediğimiz class ları
// use App\Kullanmak istediğimiz class adı olarak kullanıyoruz

//use App\User;
use App\Flight;
use App\Http\Controllers\Controller;
 
class chatController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
 
        return view('deneme', ['flights' => $flights]);
    }
}

?>