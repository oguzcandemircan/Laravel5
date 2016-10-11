<!DOCTYPE html>
<html>
<head>
	<title>Anasayfa</title>
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

<div class="panel panel-default">
  <div class="panel-heading">Gönderi Yayınla</div>
  <div class="panel-body" style="padding: 30px;">
   
<?php
	echo Form::open(array('route' => 'gonderi-gonder','method'=>'POST'));
	echo Form::textarea('gonderi',null,array('class'=>'form-control','placeholder'=>'Gönderinizi Yazın'));
	echo "</br>";
	echo Form::submit('gonder',array('class'=>'btn btn-primary pull-right'));

	
?>
  </div>
</div>


   
<?php
	
	 
	 $user_id=Auth::user()->id;
	
	foreach ($gonderiler as $gonderi) {

		$id=$gonderi->id;
		$adi=$gonderi->adi;

		echo '<div class ="panel panel-default">';
		echo '<div class ="panel-heading">Gönderen : <a href="http://192.168.1.202/slc/public/profil/'.$id.'">'.$adi.'</a>';
		if ($user_id==$id) {
			
		echo '<a href="http://192.168.1.202/slc/public/gonderi_sil/'.$gonderi->gonderi_id.'" class="pull-right">&nbsp;&nbsp;Sil</a>';
		echo '<a href="http://192.168.1.202/slc/public/gonderi_gor/'.$gonderi->gonderi_id.'" class="pull-right">Düzenle</a>';
		}
		echo '</div>';
		echo '<div class ="panel-body" style="padding: 30px;">';
		echo $gonderi->gonderi;
		echo '</br><hr></hr><span class="pull-right">Gönderi Tarihi :'.$gonderi->tarih.'</span>';
		echo '</div></div>';
	}


	
?>
  

</div><!-- /.Container -->
</body>
</html>
