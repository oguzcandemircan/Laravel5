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

function getir()
{
  var id = $('.id_al:last').attr('yaziid');
 

  $.ajax({
  type: "GET",
  url: "{{ URL::asset('yazi_al') }}",
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
  type: "GET",
  url: "{{ URL::asset('yazi_gonder') }}",
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
