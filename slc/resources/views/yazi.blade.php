
                <?php


                //$yazi=new yazi();
                //$yazilar=$yazi->all();
                  use App\User;
                  
                  $user=new User();
                  $user_id=$user->id;
        if($_GET)
        {
          if($_GET['id']!=""){

          $yazilar = DB::table('yazi')->where('yazi_id','>',$_GET['id'])->orderBy('yazi_id', 'desc')->take(1)->get();
               
                if (count($yazilar)<0) {
                   echo "count(var)";
                }
                else{
                    
                    foreach ($yazilar as $yazi){
                  $id=$yazi->id;
                  if($id==$user_id)
                  {
                    echo "<div class='id_al' yaziid='".$yazi->yazi_id."' >";
                    echo "<div class='yazan right'>".$yazi->adi."</div>";
                    echo "<div class='yazi right'>".$yazi->yazi."</div>";
                    echo "<div class='tarih '>".$yazi->tarih."</div>";
                    echo "<div class='clear'></div>";
                    echo "</div>";
                  }
                  else {

                    echo "<div class='id_al' yaziid='".$yazi->yazi_id."' >";
                    echo "<div class='yazan'>".$yazi->adi."</div>";
                    echo "<div class='yazi'>".$yazi->yazi."</div>";
                    echo "<div class='tarih'>".$yazi->tarih."</div>";
                    echo "<div class='clear'></div>";
                    echo "</div>";

                  }




                  }
                }//ELSE
              
            }//Get;
          }//$_POST
          else
          {
            echo "id gelmedi";
          }
                 ?>

