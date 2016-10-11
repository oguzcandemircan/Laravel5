<?php

namespace App\Http\Controllers;
 

// Kullanmak istediğimiz class ları
// use App\Kullanmak istediğimiz class adı olarak kullanıyoruz

//use App\User;
//use App\Flight;
use App\yazi;
use App\deneme;
use App\Http\Controllers\Controller;
 
class yaziController extends Controller
{
    public function index()
    {
        $flights = deneme::all();
 		
        return view('deneme', ['flights' => $flights]);
    }
    public function kul_kayit()
    {

    }
}

?>