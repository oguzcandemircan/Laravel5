
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

//

 

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
//////**********************************/////
/** Bildirim **/
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

/********************** Base 64 ve gönderme *****/

var Base64 = {


    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },


    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}
