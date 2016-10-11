<!DOCTYPE html>
<html>
<head>
	<title>GİRİŞ</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="width: 500px!important;margin-top: 200px;">
<a href="http://192.168.1.202/slc/public/kayit-ol" class="cikis pull-right">Kaydol</a>
<!--Hata -->
@if($errors->any())
<h4 class="alert alert-warning">{{$errors->first()}}</h4>
@endif
{{ Form::open(['route' => 'login','method'=>'GET']) }}



		<p> {{ Form::label('Email', 'Email : ' ) }}
		 {{ Form::text('email',null,array('class' => 'form-control')) }}</p>

    <p>{{ Form::label('kullaniciSifresi', 'Kullanıcı Şifresi: ') }}
    {{ Form::password('sifre',array('class' => 'form-control')) }}</p>
    <p>
    	<?php
    	 echo Form::checkbox('benihatirla'); 
    	?>
    </p>



    <p>{{ Form::submit('Giriş',array('class' => 'btn btn-primary')) }}</p>


{{ Form::close() }}


</div>
</body>
</html>
