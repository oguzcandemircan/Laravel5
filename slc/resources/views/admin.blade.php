<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sohbet</title>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <style>
body{
  background-color: #f9f9f9;
  font-size: 14px;
  font-family: arial;
  line-height:1.5;
}
.chat{

  width: 70%;
  height: 450px;
  background-color:#fff;
  padding: 20px;
  margin: auto;
  margin-top: 50px;
  border-radius: 20px;
  overflow: scroll;


}
.yazi{

  width: 300px;
  padding: 10px;
  background: #4080ff;
  color:#fff;
  border-radius: 5px;

}
.yazan{
  width: 300px;
  padding: 5px;
}
.tarih{

width: auto;
height: auto;
  color:#111;
  font-size: 12px;
}
.right{
   float:right;
  
}
.id_al
{
  
  padding: 5px;
 
}
.clear{
  clear: both;
}
.container{
  width: 100%;
  margin: auto;

}
.yazi_gonder_kutu{
  width: 70%;
  margin: auto;
  padding: 30px;
}
.txt_area{
  width:100%;
}
.sohbet{
  float: right;
}
</style>
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
                    echo "<div class='id_al sohbet col-md-12' yazan_id='".$id."' kul_id='".$user_id."' yaziid='".$yazi->yazi_id."' >";
                    echo "<div class='pull-right'><div class='yazan'>".$yazi->adi;
                    //echo "<span class='tarih pull-right'>".$yazi->tarih."</span>";
                    echo "</div>";
                    echo "<div class='yazi '>".$yazi->yazi."</div>";
                    
                    echo "<div class='clear'></div>";
                    echo "</div></div>";
                  }
                  else {

                    echo "<div class='id_al' yazan_id='".$id."' kul_id='".$user_id."' yaziid='".$yazi->yazi_id."' >";
                    echo "<div class='yazan'>".$yazi->adi;
                    //echo"<span class='tarih pull-right'>".$yazi->tarih."</span>";
                    echo "</div>";
                    echo "<div class='yazi'>".$yazi->yazi."</div>";
                    
                    echo "<div class='clear'></div>";
                    echo "</div>";

                  }




                
              }//Foreach

                 ?>
</div>
</div>
<div class="container">
    <div class="yazi_gonder_kutu">
        <textarea type="text" id="yazi_kutu_al" name="yazi" class="txt_area form-control" placeholder="Bir şeyler yazın" rows="10"></textarea><hr></hr>
          
              <input type="checkbox" name="enter" id="enter" class="enter" />
              Enter ile yazı gönderilsin.
            
        <div class="form-group pull-right">
          <button class="yazi_gonder btn btn-primary" onclick="yazi_gonder()">GÖNDER</button>
          
          <button class="btn btn-default" onclick="sohbet_temizle()">TEMİZLE</button></br><hr></hr>
        </div>
          
    </div>
</div>
<div class="hata"></div>
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

 //getir();
    scroll();
    title_deger=1;

});//document


 setInterval(function(){
  
    getir();

  }, 1500);

function getir()
{
  var id = $('.id_al:last').attr('yaziid');
 

  $.ajax({
  type: "GET",
  url: "http://192.168.1.202/slc/public/yazi_al",
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
              
              if (rahatsız_etme)
              {
                
              }
              bildirim(yazi,yazan);
              title_degistir(title_deger);
              title_deger++;

          }

         
        }

      }

  });//ajax



}//function

function yazi_gonder()
{
  $(".txt_area").prop("readonly",true);
  var yazi= $('#yazi_kutu_al').val();
   $.ajax({
  type: "GET",
  url: "http://192.168.1.202/slc/public/yazi_gonder",
  data:"yazi="+yazi,
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
