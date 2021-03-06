<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\yazi;
use App\gonderi;
use DB;
use PDO;
use Mail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Authenticatable;

class sohbetController  extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    
   public function authenticate()
    {
        $email=Input::get('email');
        $password=Input::get('sifre');
        if (Input::get('benihatirla'))
        {
             if (Auth::attempt(['email' => $email,'password' => $password],TRUE))
             {
                    
                    if(Auth::user()->onay==0){
                        
                    Auth::logout();
                    return redirect()->intended('giris')->withErrors(["Üyeliğiniz Henüz Onaylanmamış"]);
                    }
                    else{
                    return redirect()->intended('anasayfa');

                    }
             }
             else
             {
             return redirect()->route('giris')->withErrors(['Giriş Yapılmadı!']);
             }
        }
        else{
            if (Auth::attempt(['email' => $email,'password' => $password]))
                {
                   if(Auth::user()->onay==0){
                        
                    Auth::logout();
                    return redirect()->intended('giris')->withErrors(["Üyeliğiniz Henüz Onaylanmamış"]);
                    }
                    else{
                    return redirect()->intended('anasayfa');

                    }
                }
                 else
                {
                    return redirect()->route('giris')->withErrors(['Giriş Yapılmadı!']);
                }
        }
          
    



    }
    public function giris()
    {
        return view('giris');
    }

    public function sohbet()
    {
      
      // $yazi=new yazi();
      //$yazilar=$yazi->orderBy('yazi_id','desc')->limit(5)->get();/// düzenle
      //Sohbet düzenlenecek
      $yazilar=DB::table('yazi')->orderBy('yazi_id','desc')->limit(30)->get();
      $yazilar=$yazilar->reverse();
     
      return view('sohbet')->with('yazilar',$yazilar);
    }


    public function kullaniciEkle(){

        $kul_adi=Input::get('kullaniciAdi');
        $email=Input::get('email');

        
        $user_name=User::where('name',$kul_adi)->count();
        $user_email=User::where('email',$email)->count();


        if($user_email==0 && $user_name==0){

            $user = new User();
            $user->name = Input::get('kullaniciAdi');
            $user->email    =Input::get('email');
            $user->password = Hash::make(Input::get('sifre'));
            $kaydet = $user->save();
        
            if($kaydet){

            return redirect()->route('kayit-ol')->withErrors(['Başarı ile Kayıt Oldunuz']);
           
            } else{

            return redirect()->route('kayit-ol')->withErrors(['Kayıt işlemi gerçekleştirilemedi']);
            
            }

        }//if
        else{
            return redirect()->route('kayit-ol')->withErrors(['Email veya Kullanıcı Adı Zaten Kullanılıyor!']);
        }//else
        
    }//function
    public function cikis()
    {
      Auth::logout(); // log the user out of our application
      //return redirect()->intended('giris');
        return redirect()->route('giris')->withErrors(['Başarı ile Çıkış Yaptınız']);

    }
    public function yazi_al()
    {
        //$yazi=new yazi();
      
        //$yazilar =$yazi->where('yazi_id','>',5)->first();

      //return view('yazi')->with('yazilar',$yazilar);
        return view('yazi');
    }
    function yazi_gonder()
    {

        if ($_POST)
        {
            
            
        function  ayrıstır($gelen_yazi){
            
            $gelen_dizi=explode(" ",$gelen_yazi);
            
            for ($i=0; $i <count($gelen_dizi); $i++) { 
            
            $kontrol=$gelen_dizi[$i];
            
            $http=substr($kontrol,0,7);
            $https=substr($kontrol,0,8);
            $format =$kontrol=substr($kontrol,-3);
            $youtube=substr($gelen_dizi[$i],7,24);
            $youtubes=substr($gelen_dizi[$i],8,24);
    



    if ($http=="http://") {

      if ($format=="png" | $format=="jpg") {
        
         $resim='<a  ><img data-toggle="modal" data-target="#exampleModal" data-resim="'.$gelen_dizi[$i].'" src="'.$gelen_dizi[$i].'" /></a>';
         $gelen_dizi[$i]=$resim;


      }
      else if($youtube=="www.youtube.com/watch?v="){

         $you_link=substr($gelen_dizi[$i],31);
         $you='<iframe id="ytplayer" type="text/html" width="640" height="390" src="http://www.youtube.com/embed/'.$you_link.'?modestbranding=1&&rel=0&&showinfo=0&&iv_load_policy=3" frameborder="0" allowfullscreen ></iframe>';
          $gelen_dizi[$i]=$you;

      }
      
    }
    else if($https=="https://"){

      if ($format=="png" | $format=="jpg") {
        
         $resim='<a  ><img data-toggle="modal" data-target="#exampleModal" data-resim="'.$gelen_dizi[$i].'" src="'.$gelen_dizi[$i].'" /></a>';
         $gelen_dizi[$i]=$resim;


      }
      else if($youtubes=="www.youtube.com/watch?v="){

         $you_link=substr($gelen_dizi[$i],32);
          $you='<iframe id="ytplayer" type="text/html" width="640" height="390" src="http://www.youtube.com/embed/'.$you_link.'?modestbranding=1&&rel=0&&showinfo=0&&iv_load_policy=3" frameborder="0" allowfullscreen ></iframe>';
           $gelen_dizi[$i]=$you;
           
      }


    }

  }//for

  $yazi=implode(" ",$gelen_dizi);

  return $yazi;

  }//function

          $gelen_yazi=ayrıstır($_POST['yazi']);
            

            if ($gelen_yazi=="")
            {
             echo "<script>alert('Boş Mesaj Gönderilemez!')</script>";   
            }
           else{
            
           
           $user=Auth::user();
           $id=$user->id;
           $name=$user->name;

           $yazi=new yazi();
           $yazi->adi=$name;
           $yazi->id=$id;
           $yazi->yazi=$gelen_yazi;
           $save=$yazi->save();
           
           }

        }
        else{

            echo "POST Gelmedi";
        }
    }
    function kullanicilar()
    {
        $users=User::all();
        $onay=Auth::user()->onay;
        if($onay==2)
        {

            return view("user")->with("users",$users);
            
        }
        else{
            Auth::logout();
            return redirect()->route('giris')->withErrors(["Lütfen Admin Olarak Giriş Yapın!"]);
        }

    }
    function anasayfa()
    {
        $gonderiler=gonderi::orderby('gonderi_id','desc')->get();
        return view('anasayfa')->with('gonderiler',$gonderiler);
    }
    function gonderi()
    {
        $user=Auth::user();
        $id=$user->id;
        $name=$user->name;

        $gonderi=new  gonderi();
        $gonderi->gonderi=Input::get('gonderi');
        $gonderi->id=$id;
        $gonderi->adi=$name;
        $save=$gonderi->save();

        if ($save) {

             return redirect()->route('anasayfa')->withErrors(["Gönderiniz Yayınlandı."]);
        }
        else
        {
             return redirect()->withErrors(["Kayıt Edilemedi"]);
        }

    }
    public function gonderi_sil($id)
    {
        $yazan_id=Auth::user()->id;   
        $gonder=new gonderi();
        $gonderi_kontrol=$gonder->where('id',$yazan_id)->where('gonderi_id',$id)->count();
        if ($gonderi_kontrol!=0){
            
            $gonderi=new gonderi();
            $gonderi->where('gonderi_id',$id)->delete();
            return redirect()->route('anasayfa')->withErrors(["Gönderiniz Silindi."]);
        }
        else{
            return redirect()->route('anasayfa')->withErrors(["Bu Gönderi Size Ait Değil.!"]);

        }


        
    }
    public function user($id)
    {
        $user_kontrol=User::where('id',$id)->count();
        if ($user_kontrol==0){
           
           return "Böyle Bir Kullanıcı Yok!";
        }
        else{

            $users=User::where('id',$id)->get();
            
            return view('profil')->with("users",$users);
        }
    }
    public function gonderi_gor($id)
    {
        $yazan_id=Auth::user()->id;   
        $gonder=new gonderi();
        $gonderi_kontrol=$gonder->where('id',$yazan_id)->where('gonderi_id',$id)->count();
        if ($gonderi_kontrol!=0){
            
            $gonderiler=$gonder->where('id',$yazan_id)->where('gonderi_id',$id)->get();
            
            return view('gonderi_duzenle')->with("gonderiler",$gonderiler,"gid",$id);
        }
        else{
            return redirect()->route('anasayfa')->withErrors(["Bu Gönderi Size Ait Değil.!"]);

        }
    }
    function gonderi_duzenle()
    {
        if($_POST)
        {
            $id           = $_POST['id'];
            $gonderi_id   = $_POST['gonderi_id'];
            $gonderi_yazi = $_POST['gonderi'];

            $gonderi=new gonderi();                                     
            $sorgu=$gonderi->where('id',$id)->where('gonderi_id',$gonderi_id)->update(['gonderi'=>$gonderi_yazi]);
            if($sorgu)
            {
                return redirect()->route('anasayfa')->withErrors(["Başarı ile Gönderiniz Düzenlendi."]);
            }
            else
            {
                return redirect()->route('anasayfa')->withErrors(["Gönderiniz Düzenlenemedi..!"]);

            }
        }
        else{

            return redirect()->route('anasayfa')->withErrors(["İşlem gerçekleştirilemedi..!"]);
        }
    }
    function onay()
    {
         $kul_id=$_GET['kul_id'];
         $onay_id=$_GET['onay_id'];

         $user=new User();
         $update=$user->where('id',$kul_id)->update(['onay'=>$onay_id]);
         if ($update) {
             if ($onay_id==1) {
                 # code...
                 echo "<div class='alert alert-success'>Üyelik Aktif Edildi.</div>";
             }
             else
             {
                echo "<div class='alert alert-success'>Üyelik Pasif Edildi.</div>";
             }
         }
         else{
             echo "<div class='alert alert-danger'>Üyelik aktif pasif işlemi gerçekleştirilemedi!</div>";
         }

    }
    function mail_gonder()
    {
        /* $data = ['ad' => 'Tuana Şeyma', 'soyad' => 'Eldem'];

        Mail::send('mail',$data,function($mesaj)use($data)
        {
        $mesaj->to("demircanoguzcan@gmail.com")->subject("E posta başlığı");
        });*/
    }

     

}
