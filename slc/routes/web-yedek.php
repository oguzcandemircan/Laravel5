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

Route::pattern('isim', '[0-9]+');/// isim değişkenine sadece sayısal değerler girilebileceğini ayarladık.

Route::get('/', function () {
    return view('welcome');
});


Route::get('/oguz', function () {
	$oguzcan="oguzcan";
    return view('deneme')->with('ogz','oguzcan deneme değişkeni');
});


Route::get('foo', function () {
  
	//Yönlendirme;
    return redirect()->route('idli',['isim' =>'oo']);//
});


Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
    echo $commentId;
});


Route::get('deneme/{isim?}', function ($name = 'oğuzcan') {
    return $name;// url den get ile id alma id yok ise id yi oğuzcana eşitleme;
})->name('idli');

/*
Route::get('blade-deneme',function(){

	return view('home');
});
*/

//Route::get('user/profile', 'UserController@showProfile')->name('profile'); //rota isimlendirme + controller içinde ki fonksiyonu çalıştırma
Route::get('user/profile', 'UserController@denemeControl')->name('profile');

//DataBase İşlemleri.
/*
Route::get('yazilar', function(){
     $yazilar = DB::table('yazi')->get();

    foreach($yazilar as $yazi){
        echo $yazi->yazi_icerik."
";
    }

});
*/

//********** Veri Tabanı Kayıt  *****////
Route::get('yazi-ekle',function(){

$yaziEkle=DB::table('yazi')->insert(
    ['yazi_icerik' => 'john@example.com', 'yazi_aciklama' =>'aciklama']
);
if($yaziEkle)
{
	echo "Yazi Eklendi";
}

});

//********** Veri Tabanı Kayıt Dizi ile  *****////
Route::get('yazi-ekle',function(){

$dizi=array('yazi_icerik' => 'john@example.com', 'yazi_aciklama' =>'aciklama');

$yaziEkle=DB::table('yazi')->insert($dizi);
if($yaziEkle)
{
	echo "Yazi Eklendi";
}

});
//*********** Veri Tabanı Güncelleme **///////
Route::get('yazi-up',function(){

	DB::table('yazi')
            ->where('yazi_id', 1)
            ->update(['yazi_icerik' =>'laravel ile değişen içerik']);
});

//*********** Veri Tabanı Silme ild ile **///////

Route::get('yazi-del',function()
{
	DB::table('yazi')->where('yazi_id',1)->delete();

});


//************ MODEL  *******************/

Route::get('model', 'yaziController@index')->name('model');

use App\yazi;
use App\User;


Route::get('yazilar', function(){
   
	User::create([
        'yazi_icerik' => 'Bu bir deneme yazisi',
        'yazi_aciklama' => "bu-bir-deneme-yazisi"
       
    ]);

    //return "yazi kayit edildi";


});

//*************** Kullanıcı Kaydı ****///////

Route::get('/giris',function(){

	return view('kullanici_ekle');
});

Route::get('/yeni-kullanici', array(
    'as' => 'yeni-kullanici',
    'uses' => 'KullaniciController@yeniKullanici'
));
Route::post('/kullanici-ekle', array(
    'as' => 'kullanici-ekle',
    'uses' => 'KullaniciController@kullaniciEkle'
));

///**************** Kullanıcı Girişi  ***********//////

Route::get('/olustur', function(){
    $kullanici = new User;
    $kullanici->username = "laravel";
    $kullanici->password = Hash::make("1234");
    $kullanici->save();
});

Route::resource('sessions', 'SessionController');

 Route::get('/admin', function(){
        return "Admin Sayfası";
    });

   // Route::get('/login', 'SessionController@create');

     //kullanıcı
     //Route::get('/logout', 'SessionController@destroy');

///********* Laravel Chat Uygulaması *******/

