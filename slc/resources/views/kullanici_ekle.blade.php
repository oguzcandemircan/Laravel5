<!DOCTYPE html>
<html>
<head>
	<title>SLC Anlık Sohbet Kayıt</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>
<body>

<div class="container" style="width: 500px!important;margin-top: 200px;">
<a href="http://192.168.1.202/slc/public/giris" class="cikis pull-right">Giriş Yap</a>
<!--Hata -->
@if($errors->any())
<h4 class="alert alert-warning">{{$errors->first()}}</h4>
@endif

{{ Form::open(['route' => 'kayit','method'=>'GET']) }}


   <p> {{ Form::label('kullaniciAdi', 'Kullanıcı Adı: ' ) }}
    {{ Form::text('kullaniciAdi',null,array('class' => 'form-control')) }}</p>

		<p> {{ Form::label('Email', 'Email : ' ) }}
		 {{ Form::text('email',null,array('class' => 'form-control')) }}</p>


    <p>{{ Form::label('kullaniciSifresi', 'Kullanıcı Şifresi: ') }}
    {{ Form::password('sifre',array('class' => 'form-control')) }}</p>



    <p>{{ Form::submit('Kaydol',array('class' => 'btn btn-success')) }}</p>


{{ Form::close() }}


</h1>
</body>
</html>
