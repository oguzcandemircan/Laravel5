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
	
    return redirect()->route('giris');
});


//Route::get('/kok','HomeController@Index', function () {

//});

//Route::resourse('/users','UserController');



//***** Giriş Yapanların Eriştiği Kısım ****///
Route::group(['middleware' => ['auth']], function () {

     // bu kısma her eklediğin  routelandırma auth korumasında oluçaktır.login olmayan bu kısma ulaşamıyacak.

    Route::get('sohbet' ,'sohbetController@sohbet', function()
        {


        });


    Route::get('anasayfa','sohbetController@anasayfa',function()
    	{

    	})->name('anasayfa');

	Route::post('gonderi-gonder','sohbetController@gonderi',function(){


	})->name('gonderi-gonder');
	
	Route::get('profil/{id}','sohbetController@user',function(){

	})->name('profil');

	Route::get('gonderi_sil/{id}','sohbetController@gonderi_sil',function(){

	})->name('gonderi_sil');

	Route::get('gonderi_gor/{id}','sohbetController@gonderi_gor',function(){

	})->name('gonderi');

	Route::post('gonderi_duzenle','sohbetController@gonderi_duzenle',function(){

	})->name('gonderi_duzenle');

	Route::get('users','sohbetController@kullanicilar',function(){

	});

	Route::get('cikis','sohbetController@cikis',function(){


	})->name('cikis');

	Route::get('yazi_al','sohbetController@yazi_al',function(){
 
	})->name('yazi_al');

	Route::post('yazi_gonder','sohbetController@yazi_gonder',function(){

	})->name('yazi_gonder');

	Route::get('onay','sohbetController@onay',function()
	{

	})->name('onay');

});//middleware;


Route::get('kayit','sohbetController@kullaniciEkle',function(){


})->name('kayit');



Route::get('kayit-ol',function(){
 return view('kullanici_ekle');
})->name('kayit-ol');


Route::get('login','sohbetController@authenticate',function()
{

})->name('login');

Route::get('giris','sohbetController@giris',function(){


})->name('giris');



Route::get('mail','sohbetController@mail_gonder',function(){

	
});


Route::get('post_deneme',function()
{
	return view('test');	
});

Route::post('posts',function()
{
	return $_POST['text'];
});