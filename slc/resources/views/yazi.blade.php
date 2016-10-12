
                <?php


                //$yazi=new yazi();
                //$yazilar=$yazi->all();
                 
                  $user_id=Auth::user()->id;
        if($_GET)
        {
          if($_GET['id']!=""){

          $yazilar = DB::table('yazi')->where('yazi_id','>',$_GET['id'])->orderBy('yazi_id', 'desc')->take(1)->get();
               
                if (count($yazilar)<0) {
                   echo "gelmedi";
                }
                else{
                    
                    foreach ($yazilar as $yazi){
                  $id=$yazi->id;

                  if($id==$user_id)
                  {
                     echo "<div class='id_al sohbet col-md-12' yazan_id='".$id."' kul_id='".$user_id."' yaziid='".$yazi->yazi_id."' >";
                    echo "<div class='pull-right'><div class='yazan'>".$yazi->adi;
                    //echo "<span class='tarih pull-right'>".$yazi->tarih."</span>";
                    echo "</div>";
                    echo "<div class='yazi '>".$yazi->yazi."</div>";
                    
                    echo "<div class='clear'></div>";
                    echo "</div></div>";
                  }
                  else {

                    echo "<div class='id_al' kul_id='".$user_id."' yaziid='".$yazi->yazi_id."' >";
                    echo "<div class='yazan'>".$yazi->adi."</div>";
                    echo "<div class='yazi'>".$yazi->yazi."</div>";
                   // echo "<div class='tarih'>".$yazi->tarih."</div>";
                    echo "<div class='clear'></div>";
                    echo "</div>";

                  }




                  } 
                }//ELSE
              
            }//Get;
            else{
              //GET else ;

                echo "gelmedi";
            }
          }//$_POST
          else
          {
            echo "gelmedi";
          }
                 ?>

