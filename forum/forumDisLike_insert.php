
<?php

//----------FORUM -DISLIKE----------------------------------------------------------


// (plusz a nevek kiirasa is itt van)

//Ha van POST:
//1. user_id lekerese a user tablabol, 
//2. dislike_to_userid lekerese a hozzaszolasok tablabol (mert csak 1-szer lehet dislajkolni - vizsgalat)
//3. vizsgalat (explode) csak 1-szer lehet dislajkolni -ne lehessen ketto ugyanolyan a user_id. 
//4. vizsgalat (LIKE - adatok lekerese az adatbazisbol) - ne lehessen egyszerre like-olni- dislikeolni!
//5. UserId hozzafuzese (concat) a 'dislike_to_userid'hez (hozzaszolasok tablaba).   
//6. dislike novelese eggyel (hozzaszolasok tabla).
//7. (vizsgalat -> implode) 
//8. dislike_to_userid felulirasa (hozzaszolasok tabla). 
//9. dislike csokkentese egyel (hozzaszolasok tabla).




// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if  (isset($_POST["hozzid"])) {


        

        // Az AJAX keresbol kapott adatok lekerese
        $hozzid = $_POST['hozzid'];


       //1. user_id lekerese a user tablabol -------------------------------------------------------------------------------------

       $sql2 = 'SELECT * FROM `users` where `User_Hash` = "'.$_SESSION['User_Hash'].'"';
 
       $result2 = mysqli_query($conn,$sql2);

       while ( $row2 = $result2->fetch_assoc() ){
               $users[] = $row2;
              }  
             
              $user_id = $users[0]['UserID'];
            
             if (mysqli_query($conn, $sql2)) {
                echo "UserId select successfully";
            } else {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }


        //2. dislike_to_userid lekerese a hozzaszolasok tablabol --------------------------------------------------------------------
        $sql4 = 'SELECT * FROM `discussions` WHERE `comment_id` = "'.$hozzid.'"';

        $result4 = mysqli_query($conn,$sql4);

         while ( $row4 = $result4->fetch_assoc() ){
                 $discuss = $row4;
                }  
               
               $like_to_userid = $discuss['like_to_userid'];
               $dislike_to_userid = $discuss['dislike_to_userid'];
          
          
            if (mysqli_query($conn, $sql4)) {
                echo "UserId select successfully";
            } else {
                echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
            }
            
                
        //3.Vizsgalat (explode) -------------------------------------------------------------------------------------------------
        
        $DisLikeUserIds = (explode(",",$dislike_to_userid));
        
        $dislikeable=0;
        foreach ($DisLikeUserIds as $k => $v) {
            if ($v == $user_id){$dislikeable++;} 
           }
     
       
       
       
        //4. vizsgalat (like -oszlop ) -----------------------------------------------------------------------------------------
       //ha nulla a like, csak akkor lehet majd dislajkolni.
       $LikeUserIds = (explode(",",$like_to_userid));
        
       $like=0;
       foreach ($LikeUserIds as $k => $v) {
           if ($v == $user_id){$like++;}       
          } 
        
      
      
       //------------------------------------------------------------------------------------------------------------------------------

         //ha a dislikeable != 0 ->nemjo! (mar van olyan id)
         //vagy ha user_id null vagy ha like nem nulla! 
          if ( ($dislikeable == 0) && (isset($user_id)) && ($like == 0)  ) {


  
                //5. uj UserID hozzafuzese a dislike_to_userid-hez (hozzaszolasok tabla) -------------------------------------------------
            
                
                   $sql3 = 'UPDATE `discussions` SET `dislike_to_userid` = CONCAT(`dislike_to_userid`, ",'.$user_id.'") WHERE `comment_id` = "'.$hozzid.'"';


                        if (mysqli_query($conn, $sql3)) {
                            echo "UserId inserted successfully";
                        } else {
                            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                        }

                
                // 6. dislike ertekenek novelese eggyel ------------------------------------------------------------------------------------------

                    $sql = 'UPDATE `discussions` SET `comment_dislike` = `comment_dislike` + 1 WHERE `comment_id` = "'.$hozzid.'"';

                    if (mysqli_query($conn, $sql)) {
                        echo "DisLike inserted successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

         
                // nevek hozzaadasa (dislike_to_uname)-----------------------------------------------------------------------------------------------------
                                         
                         unset($DisLikeUserIds[0]);
                         $disLikeUserIdsPlus=array_push($DisLikeUserIds,$user_id);
                          
                        $sql_all = 'SELECT `User_Name` FROM `users` WHERE `UserID` IN (' . implode(',', array_map('intval', $DisLikeUserIds)) . ')';
                       
                        $resultAll = mysqli_query($conn,$sql_all);
                        $strName='';
                        while ($row_all = $resultAll->fetch_assoc()){
                              $disLikeAllName[] = $row_all;
                            }
                    
                     foreach ($disLikeAllName as $k => $v) {
                          $strName.= $disLikeAllName[$k]['User_Name'].', ';
                        
                      }
                           $uname = rtrim($strName, ', ');
                      
                                      
                        $sqlAll = 'UPDATE `discussions` SET `dislike_to_uname` = "'.$uname.'" WHERE `comment_id` = "'.$hozzid.'"'; 
                        if (mysqli_query($conn, $sqlAll)) {
                                    echo "Like inserted successfully";
                                } else {
                                    echo "Error: " . $sqlAll . "<br>" . mysqli_error($conn);
                                }
   
             


            

    }


        // 7.-----------------------------------------------------------------------------------------------------------------------------------
        //ha a dislikeable == 1 ->(mar van olyan id) dislike_to_userid feluliras es dislike csokkentes !
                 
        if ( ($dislikeable > 0) && (isset($user_id)) ) {
        
                    $arr_dislike=[];
                    foreach ($DisLikeUserIds as $k => $v) {
                    if ($v != $user_id){$arr_dislike[]=$v;}
                    }
                    
                    $newDisLikeUserIds = implode(",",$arr_dislike);
                


                //8. dislike_to_userid  felulirasa  (hozzaszolasok tablaba) ----------------------------------------------------------------------

                    $sql3 = 'UPDATE `discussions` SET `dislike_to_userid` =  "'.$newDisLikeUserIds.'" WHERE `comment_id` = "'.$hozzid.'"';
                    
                    if (mysqli_query($conn, $sql3)) {
                        echo "dislike_to_userid inserted successfully";
                    } else {
                        echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                    }

            
                // 9. dislike csokkentese eggyel --------------------------------------------------------------------------------------------------

                    $sql = 'UPDATE `discussions` SET `comment_dislike` = `comment_dislike` - 1 WHERE `comment_id` = "'.$hozzid.'"';

                    if (mysqli_query($conn, $sql)) {
                        echo "DisLike inserted successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
         
                 //nevek torlese (dislike_to_uname)-----------------------------------------------------------------------------------------------------
            
                          $string_dislike="";
                          $strDisIds = ltrim($newDisLikeUserIds, ',');
                          $sql_del_dislike = 'SELECT `User_Name` FROM `users` WHERE `UserID` IN ('.$strDisIds.')';
                          
                          $resultAllDis = mysqli_query($conn,$sql_del_dislike);
                           
                          if ($resultAllDis !='') {
                            
                              while ($row_all = $resultAllDis->fetch_assoc()){
                                    $dislike_Nams[] = $row_all;
                                    }
                               
                                      $userNamesDis = array();
                                      foreach ($dislike_Nams as $itemDis) {
                                          $userNamesDis[] = $itemDis["User_Name"];
                                          $string_dislike = implode(", ", $userNamesDis); 
                                      }
                                       print_r($string_dislike); // die();
                                     
                            }        
                           
                                       
                        $sqlAllDis = 'UPDATE `discussions` SET `dislike_to_uname` = "'.$string_dislike.'" WHERE `comment_id` = "'.$hozzid.'"'; 
                        if (mysqli_query($conn, $sqlAllDis)) {
                                    echo "Like inserted successfully";
                                } else {
                                    echo "Error: " . $sqlAllDis . "<br>" . mysqli_error($conn);
                                }
     
     
     
     
     
        }





         
    
    
}



$conn->close();
?>


