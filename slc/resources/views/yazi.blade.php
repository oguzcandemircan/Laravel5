
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
                   
                   
                    echo '<div class="row sag id_al" yazan_id="'.$id.'" kul_id="'.$user_id.'" yaziid="'.$yazi->yazi_id.'">';
                    echo '<div class="col-md-7 col-sm-6"></div>';
                    echo '<div class="col-md-5 col-sm-6 div_sag yazi">'.$yazi->yazi.'</div>';
                    echo '</div>';//row
                   
                  }
                  else{

                    echo '<div class="row sol id_al" yazan_id="'.$id.'" kul_id="'.$user_id.'" yaziid="'.$yazi->yazi_id.'">';
                    echo '<div class="col-md-5 col-sm-6 div_sol">';
                    echo '<span class="yazan_span yazan">'.$yazi->adi.'</span><hr class="hr"></hr>';
                    echo '<span class="yazi">'.$yazi->yazi.'</span>';
                    echo '</div>';
                    echo '</div>';

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

