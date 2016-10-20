<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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

<div class="goster"></div>
    </body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

{!! Html::script('js/sohbet.js'); !!}
<script type="text/javascript">
  
  function getir(){
  var id = $('.id_al:last').attr('yaziid');
  $.ajax({
  type: "GET",
  url: "{{ URL::asset('yazi_al') }}",
  data:"id="+id,
  error:function(){ getir();scroll();}, 
  success: function(veri) {
       $("#yazdir").append(veri);
       if (veri!="") 
        {
          scroll();

          var yazan_id = $('.id_al:last').attr('yazan_id');
          var kul_id = $('.id_al:last').attr('kul_id');

          if (yazan_id!=kul_id){
              
              var yazi = $(".yazi:last").html();
              var yazan = $(".yazan:last").html();
              
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

//////////////////////

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
  type: "POST",
  url: "{{ URL::asset('yazi_gonder') }}",
   headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
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
}//else
}

</script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        
      </div>
   
    </div>
  </div>
</div>

<script type="text/javascript">
  
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var resim = button.data('resim') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body').html("<img src='"+resim+"' />")

})

</script>

<style type="text/css">

   .modal-dialog{
    width:80%!important;
    max-height:700px!important;
    margin-top:10px!important;
    background: none!important;

    
  }
  .modal-content
  {
    border:none!important;
  }
  .modal-body
  {
    background: #f9f9f9!important;
    border:none!important;
  }

  .btn-primary{
    background-color: #4080ff!important;
    boder-color: #4080ff!important;

  }

</style>

</html>
