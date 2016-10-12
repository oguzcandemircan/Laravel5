<!DOCTYPE html>
<html>
<head>
	   <title>Anasayfa</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>
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
<div class="container" style="width:600px;margin-top:100px;">
<!--Hata -->
@if($errors->any())
<h4 class="alert alert-warning">{{$errors->first()}}</h4>
@endif
<div class="panel panel-default">
  <div class="panel-heading">Gönderi Yayınla</div>
  <div class="panel-body" style="padding: 30px;">
<?php
    foreach ($gonderiler as $gonderi) {
         

    echo Form::open(['route'=>'gonderi_duzenle','method'=>'POST']);
    echo Form::textarea('gonderi',$gonderi->gonderi,array('class'=>'form-control ckeditor'));
    echo Form::hidden('id',$gonderi->id);
    echo Form::hidden('gonderi_id',$gonderi->gonderi_id)."</br>";
    echo Form::submit('Düzenlemeyi Tamamla',array('class'=>'btn btn-primary pull-right'));   
    
    }


?></div></div>
</div>
</body>
</html>
