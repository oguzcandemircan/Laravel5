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



<?php

	foreach ($users as $user) {
                echo "<div style='margin:auto;width:500px;margin-top:100px;'>";
                echo "<h3>Kullanıcı Profil Sayfası</h3></br></br>";
                echo "<strong> ID :</strong>".$user->id."<hr></hr>";
                echo "<strong> Kullanıcı adı :</strong> ".$user->name."<hr></hr>";
                echo "<strong> Email :</strong>".$user->email."<hr></hr>";
                echo "</div>";
            }

?>
  

</div><!-- /.Container -->
</body>
</html>
