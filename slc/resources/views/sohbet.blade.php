<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sohbet</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 {!! Html::style('css/sohbet.css'); !!}
      
    </head>
    
    <body>
<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="http://192.168.1.202/slc/public/anasayfa">Anasayfa</a></li>
              <li><a href="http://192.168.1.202/slc/public/profil/<?php echo Auth::user()->id;?>">Profil</a></li>
              <li><a href="http://192.168.1.202/slc/public/sohbet">Sohbet</a></li>
              <li><a href="http://192.168.1.202/slc/public/cikis">Cıkış</a></li>
             
            </ul>
          
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<div class="chat">
<div id="yazdir">
  <?php


                  $user_id=Auth::user()->id;

                foreach ($yazilar as $yazi)
                {
                  $id=$yazi->id;
                  if($id==$user_id)
                  {
                   
                   
                    echo '<div class="row sag id_al" yazan_id="'.$id.'" kul_id="'.$user_id.'" yaziid="'.$yazi->yazi_id.'">';
                    echo '<div class="col-md-7 col-sm-6"></div>';
                    echo '<div class="col-md-5 col-sm-6 div_sag yazi">'.$yazi->yazi.'</div>';
                    echo '</div>';//row
                   
                  }
                  else{

                    echo '<div class="row sol id_al" yazan_id="'.$id.'" kul_id="'.$user_id.'" yaziid="'.$yazi->yazi_id.'">';
                    echo '<div class="col-md-5 col-sm-6 div_sol">';
                    echo '<span class="yazan_span yazan">'.$yazi->adi.'</span><hr class="hr"></hr>';
                    echo '<span class="yazi">'.$yazi->yazi.'</span>';
                    echo '</div>';
                    echo '</div>';

                  }
                  




                
              }//Foreach

                 ?>
</div>
</div>

<div class="container">
    <div class="yazi_gonder_kutu">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                 <textarea type="text" id="yazi_kutu_al" name="yazi" class="txt_area form-control" placeholder="Bir şeyler yazın" rows="9"></textarea><hr></hr>
            </div>
            <div class="col-md-1"></div>
        </div>
    
        <div class="row"><div class="col-md-1"></div>
            <div class="col-md-5">
            
            
                <div class="form-group">
                    <input type="checkbox" name="enter" checked="checked" id="enter" class="enter" />
                        Enter ile yazı gönderilsin.
                   
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group pull-right">
                    <button class="yazi_gonder btn btn-primary" onclick="yazi_gonder()">GÖNDER</button>
                    <button class="btn btn-default" onclick="sohbet_temizle()">TEMİZLE</button>
            
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-12 text-center">
                    <button class="btn btn-success" name="time1" onclick="zaman(30,1)" id="time1">Rahatsız Etme  +30</button>
                    <button class="btn btn-default" name="time2" onclick="zaman(30,0)" id="time2">Rahatsız Etme  -30</button>
                    <hr class="hr2"></hr><div class="kul_zaman"></div>
            </div>
        </div>
          
        
          
    </div><!-- yazi gönder kutu -->
</div><!-- Container -->
<div class="hata"></div>

<div class="gercek_zaman" style="display:none"></div>

<div class="goster">
  
</div>
    </body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

  function link()
{
  var kutu =$(".txt_area").val().replace(/\n/g, " ");
  //$(".goster").html(kutu);
  
  
  
  var dizi=new Array();
  dizi = kutu.split(' ')
  for (var i = 0; i <dizi.length; i++) {
    var link = dizi[i];
    var htp =link.substring(0,7);
    var htps =link.substring(0,8);
    var youtube = link.substring(7,31);
    var youtubes= link.substring(8,32);
    $(".goster").append(youtube);
    
    if(htp=="http://")
    {

      var png=link.substring(link.length-4,link.length);
      if (png==".png")
      {
        link="<a href='"+link+"' target='_blank'><img src='"+link+"' /></a>";
        //$('.goster').append("</br>"+link);
        dizi[i]=link;
      }
      else if (png==".jpg")
      {
        link="<a href='"+link+"' target='_blank'><img src='"+link+"' /></a>";
        //$('.goster').append("</br>"+link);
        dizi[i]=link;
      }
      else if(youtube="www.youtube.com/watch?v=")
      { 

        link=link.substring(32,link.length);
        var video='<iframe width="560" height="315" src="http://www.youtube.com/embed/'+link+'" frameborder="0" allowfullscreen></iframe>';
        dizi[i]=video;
      }
      
    }
    if(htps=="https://")
    {

      if (png==".png")
      {
        link="<a href='"+link+"' target='_blank'><img src='"+link+"' /></a>";
        //$('.goster').append("</br>"+link);
        dizi[i]=link;
      }
        if (png==".jpg")
      {
        link="<a href='"+link+"' target='_blank'><img src='"+link+"' /></a>";
        //$('.goster').append("</br>"+link);
        dizi[i]=link;
      }
      if(youtubes="www.youtube.com/watch?v=")
      {   
          link=link.substring(32,link.length);
         var video='<iframe src="https://www.youtube.com/embed/'+link+'" frameborder="0" allowfullscreen></iframe>';
        dizi[i]=video;
      }

    }

    
    //$(".goster").append("</br>"+link);
  }
  var temiz = dizi.join(" ");
  //$('.goster').html("</br>"+temiz);
  //$('.txt_area').html(temiz);

  return temiz;
  
}
$(document).ready(function(){

 //getir();
    scroll();
    title_deger=1;
    $("body").scrollTop(400);
    
    
});//document

var d1 = new Date (); 
    var d2 = new Date ();
    //$(".gercek_zaman").html("saat :"+d1.getHours()+" dakika :"+d1.getMinutes());
    $(".kul_zaman").html(d2.getHours()+":"+d2.getMinutes());
 setInterval(function(){
  
    getir();

  }, 1500);

function getir()
{
  var id = $('.id_al:last').attr('yaziid');
 

  $.ajax({
  type: "GET",
  url: "{{ URL::asset('yazi_al') }}",
  data:"id="+id,
  error:function(){ 
   //$(".hata").html("Bir hata algılandı."); 
   getir();
   scroll();
   }, 
  success: function(veri) {

       $("#yazdir").append(veri);
              

       if (veri!="") 
        {
          scroll();
          
          var yazan_id = $('.id_al:last').attr('yazan_id');
          var kul_id = $('.id_al:last').attr('kul_id');

          if (yazan_id!=kul_id){
              
              var yazi = $(".yazi:last").html();
              var yazan = $(".yazan:last").html()
              //$(".hata").html(yazan);
              
              
                if (zaman(1,0)==true)
                {
                  bildirim(yazi,yazan);
                  title_degistir(title_deger);
                  title_deger++;
                  $('body').append('<audio controls controls autoplay><source src="http://192.168.1.202/slc/resources/views/ding.mp3" type="audio/mpeg">Tarayıcınız audio elementini desteklemiyor.</audio>')
                 
                }
                else{
                  
                }
              
              

          }

         
        }

      }

  });//ajax



}//function

 

function zaman(dk,tur)
{
  var bildirim=false;
  if (tur==1) 
  {
    var kul_dakika=d2.setMinutes ( d2.getMinutes() + dk );
    //alert ( " saat : "+d2.getHours()+" dakika :"+d2.getMinutes() );
    $(".kul_zaman").html(d2.getHours()+":"+d2.getMinutes());

    
   
  }
  else{
    var kul_dakika=d2.setMinutes ( d2.getMinutes() - dk );
    //alert ( " saat : "+d2.getHours()+" dakika :"+d2.getMinutes() );
    $(".kul_zaman").html(d2.getHours()+":"+d2.getMinutes());
    
  }
          
     if(d1.getHours()>=d2.getHours())
    {             
       //alert("Bildirim alabilir saat");
      if(d1.getMinutes()>d2.getMinutes())
      {    
            //alert("Bildirim alabilir dk");
           bildirim=true;
      }
      else{

          bildirim=false;
      }
    }
    else{
      bildirim=false;
    }

    return bildirim;

  //if (kul_dakika>60) { kul_dakika=0;}
  //$(".hata").html(kul_dakika);
}

function yazi_gonder()
{
  if ($(".txt_area").val()=="" | $(".txt_area").val()==null)
  { $(".txt_area").prop("disabled",true);
    $(".txt_area").addClass("timeout");
    $(".txt_area").val("5 Saniye boyunca mesaj göndermeniz engellendi!");
    alert("Boş mesaj gönderdiğiniz için 5 saniye boyunca mesaj göndermeniz engellendi.");
    setTimeout(function(){
      $(".txt_area").prop("disabled",false);
      $(".txt_area").val("");
      $(".txt_area").removeClass("timeout");

    },5000);
  }
  else
  {

  $(".txt_area").prop("readonly",true);
  var yazi= $('#yazi_kutu_al').val();
   $.ajax({
  type: "GET",
  url: "{{ URL::asset('yazi_gonder') }}",
  data:"yazi="+link(),
  error:function(){
   //$(".hata").html("Bir hata algılandı."); 
   yazi_gonder();
   scroll();

 }, 
  success: function(veri) {
   $("#yazdir").append(veri); 
   $(".txt_area").val(""); 
   $(".txt_area").prop("readonly",false);
 }


  });//ajax
}//else
}
///***************************************/

   
  function title_degistir(deger)

  {
    $("title").html("Sohbet("+deger+")");
    /*x=3;
    setInterval(function(){
  
    if (x%2==0){
      
        $("title").html("Sohbet")
    }
    else{
        $("title").html("Sohbet("+deger+")");
    } 
    x++;
       }, 1500);*/


  }

$("body").click(function(){

  $("title").html("Sohbet");

});



 $('#yazi_kutu_al').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
     if(document.getElementById('enter').checked)
    {
       yazi_gonder();
    }
    
  }
});



/*******************************************/






function scroll()
{
  $(".chat").scrollTop($("#yazdir").height());
  
}
function sohbet_temizle()
{
  $("#yazdir").html("Sobet Temizlendi");
}

</script>
<script type="text/javascript">
  function bildirim (yazi,yazan) {

    var yazi = yazi.replace(/(<([^>]+)>)/ig,"");


  // İlk kontrol tarayıcının bu özelliği destekleyip desteklemediğini sorgulamak
  if (!("Notification" in window)) {
    alert("Bu tarayıcı web bilgilendirme özelliğini desteklemiyor.");
  } 

  // Daha önce kullanıcı izin verdi ise
  else if (Notification.permission === "granted") {
    // Bilgilendirme popup'ını çıkaralım.
    var notification = new Notification('SLC Anlık Chat : '+yazan, {
      body: yazi, 
      icon: 'http://i.hizliresim.com/pEAdqL.png',
      tag: 'tag',
      dir: 'auto',
      lang: ''
    });
  }
  
  // Eğer onay yoksa
  else if (Notification.permission !== 'denied') {
    // Kullanıcıdan onay ise
    Notification.requestPermission(function (permission) {
      // Kullanıcı onaylamadı ise tekrar soralım
      if (permission === "granted") {
        // onaylarsa bilgilendirme popup'ı aç
        var notification = new Notification('SLC Anlık Chat : '+yazan, {
          body: yazi, 
          icon: 'http://i.hizliresim.com/pEAdqL.png',
          tag: 'tag',
          dir: 'auto',
          lang: ''
        });
       }
    });
  }
}
</script>
</html>
