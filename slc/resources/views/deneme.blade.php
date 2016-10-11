<!DOCTYPE html>
<html>
<head>
	<title>Laravel deneme blade</title>
</head>
<body>
<h3> Deneme blade view</h3>
<h1>


          @foreach($flights as $yazi)
                {{ $yazi->yazi_icerik }}
          @endforeach
{{ Form::open(['route' => 'kullanici-ekle']) }}


    {{ Form::label('kullaniciAdi', 'Kullanıcı Adı: ' ) }}
    {{ Form::text('kullaniciAdi') }}



    {{ Form::label('kullaniciSifresi', 'Kullanıcı Şifresi: ') }}
    {{ Form::password('sifre') }}



    {{ Form::submit('Yeni Kullanıcı') }}


{{ Form::close() }}

	
</h1>
</body>
</html>