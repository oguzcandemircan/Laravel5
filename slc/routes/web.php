<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/', function () {
	redirect()->route('giris');
    return view('welcome');
});


//Route::get('/kok','HomeController@Index', function () {

//});

//Route::resourse('/users','UserController');



//***** Giriş Yapanların Eriştiği Kısım ****///
Route::group(['middleware' => ['auth']], function () {

     // bu kısma her eklediğin  routelandırma auth korumasında oluçaktır.login olmayan bu kısma ulaşamıyacak.

    Route::get('sohbet' ,'LoginController@sohbet', function()
        {


        });


    Route::get('anasayfa','LoginController@anasayfa',function()
    	{

    	})->name('anasayfa');

	Route::post('gonderi-gonder','LoginController@gonderi',function(){


	})->name('gonderi-gonder');
	
	Route::get('profil/{id}','LoginController@user',function(){

	})->name('profil');

	Route::get('gonderi_sil/{id}','LoginController@gonderi_sil',function(){

	})->name('gonderi_sil');

	Route::get('gonderi_gor/{id}','LoginController@gonderi_gor',function(){

	})->name('gonderi');

	Route::post('gonderi_duzenle','LoginController@gonderi_duzenle',function(){

	})->name('gonderi_duzenle');

	Route::get('users','LoginController@kullanicilar',function(){

	});

	Route::get('cikis','LoginController@cikis',function(){


	})->name('cikis');

	Route::get('yazi_al','LoginController@yazi_al',function(){
 
	})->name('yazi_al');

	Route::get('yazi_gonder','LoginController@yazi_gonder',function(){

	})->name('yazi_gonder');

});//middleware;


Route::get('kayit','LoginController@kullaniciEkle',function(){


})->name('kayit');



Route::get('kayit-ol',function(){
 return view('kullanici_ekle');
})->name('kayit-ol');


Route::get('login','LoginController@authenticate',function()
{

})->name('login');

Route::get('giris','LoginController@giris',function(){


})->name('giris');





