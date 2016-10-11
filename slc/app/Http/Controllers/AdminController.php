<?php


namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Auth;

class KullaniciController  extends Controller
{



//if içindeki email ve password alan adları databasle aynı olmalıdır.!!!!!!!!!!!!!!
	//$email="oguzcan";
	//$password="12321";

if (Auth::attempt(Input::except['_token']))
{
  
  return 'Login oldunuz'; // Gideceğin sayfa...
}
else
{
   return redirect('login')->with('error','Böyle bir kullanıcı yoktur.');
}



}
?>