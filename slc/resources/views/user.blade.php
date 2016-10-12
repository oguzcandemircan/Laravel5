<!DOCTYPE html>
<html>
<head>
	<title>Kullanıcılar</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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


<div class="container" style="width: 700px!important;margin-top: 20px;">
@if($errors->any())
<div class="alert alert-success">{{$errors->first()}}</div>
@endif
 <div class="sonuc"></div>



<?php

	foreach ($users as $user) {
            
            $onay=$user->onay;
            if($onay==1)
            {
              
              echo "<select class='form-control' id='".$user->id."' style='width:80px;' onchange='onay(".$user->id.")'><option value='1'>aktif</option><option value='0'>pasif</option></select>";
              
            }
            else
            {
              
              echo "<select class='form-control' id='".$user->id."' style='width:80px;' onchange='onay(".$user->id.")'><option value='0'>pasif</option><option value='1'>aktif</option></select>";

            }
            


            echo "Kullanıcı Adı :".$user->name."</br>";
            echo "Kullanıcı Email :".$user->email."</br></br><hr></hr>";
            
        }

?>
 <input type="checkbox" name="vehicle" value="Bike">Aktif<br>
</div><!-- /.Container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">



function onay(id)
{
 
 var onay_id = $("#"+id).val();


   $.ajax({
  type: "GET",
  url: "http://192.168.1.202/slc/public/onay",
  data:"kul_id="+id+"&onay_id="+onay_id,
  error:function(){$(".sonuc").html("Bir hata algılandı."); }, 
  success: function(veri) {
   $(".sonuc").html(veri);
 }

  });//ajax

}
</script>
</body>
</html>
