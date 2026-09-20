
<?php

//----------FORUM -LIKE----------------------------------------------------------


// (plusz a nevek kiirasa is itt van)
//Ha van POST:
//1. user_id lekerese a user tablabol, 
//2. like_to_userid lekerese a hozzaszolasok tablabol (mert csak 1-szer lehet lajkolni)
//3. vizsgalat (explode) csak 1-szer lehet lajkolni -ne lehessen ketto ugyanolyan a user_id. 
//4. vizsgalat (DISLIKE - adatok lekerese az adatbazisbol) - ne lehessen egyszerre like-olni- dislikeolni!
//5. UserId hozzafuzese (concat) a 'like_to_userid'hez (hozzaszolasok tablaba).   
//6. like novelese egyel (hozzaszolasok tabla).
//7. (vizsgalat -> implode) 
//8. like_to_userid felulirasa (hozzaszolasok tabla). 
//9. like csokkentese egyel (hozzaszolasok tabla).

//

if  (isset($_POST["hozzid"])) {
    
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  

        

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


        //2. like_to_userid lekerese a hozzaszolasok tablabol --------------------------------------------------------------------
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
        
        $LikeUserIds = (explode(",",$like_to_userid));
        
        $likeable=0;
        foreach ($LikeUserIds as $k => $v) {
            if ($v == $user_id){$likeable++;} 
           }
     
       //4. vizsgalat (dislike -oszlop ) -----------------------------------------------------------------------------------------
       //ha nulla a dislike, csak akkor lehet majd lajkolni.
       $disLikeUserIds = (explode(",",$dislike_to_userid));
        
       $dislike=0;
       foreach ($disLikeUserIds as $k => $v) {
           if ($v == $user_id){$dislike++;}       
          } 
        
      
      
   // POZITIV AG (NOVELES)--------------------------------------------------------------------------------------------------------------------------
       
       
         //ha a likeable != 0 ->nemjo! (mar van olyan id)
         //vagy ha a user_id null vagy ha van mar dislike 
        if ( ($likeable == 0) && (isset($user_id)) && ($dislike == 0 )  ) {
    
           

  
                //5. uj UserID hozzafuzese a like_to_userid-hez (hozzaszolasok tabla) --------------------------------------------------
                            
                   $sql3 = 'UPDATE `discussions` SET `like_to_userid` = CONCAT(`like_to_userid`, ",'.$user_id.'") WHERE `comment_id` = "'.$hozzid.'"';


                        if (mysqli_query($conn, $sql3)) {
                            echo "UserId inserted successfully";
                        } else {
                            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                        }

                
                // 6. like novelese egyel ---------------------------------------------------------------------------------------------

                    $sql = 'UPDATE `discussions` SET `comment_like` = `comment_like` + 1 WHERE `comment_id` = "'.$hozzid.'"';
                    
                    if (mysqli_query($conn, $sql)) {
                        echo "Like inserted successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

            
                // nevek hozzaadasa (like_to_uname)-----------------------------------------------------------------------------------------------------
                                         
                         unset($LikeUserIds[0]);
                         $LikeUserIdsPlus=array_push($LikeUserIds,$user_id);
                          
                        $sql_all = 'SELECT `User_Name` FROM `users` WHERE `UserID` IN (' . implode(',', array_map('intval', $LikeUserIds)) . ')';
                       
                        $resultAll = mysqli_query($conn,$sql_all);
                        $strName='';
                        while ($row_all = $resultAll->fetch_assoc()){
                              $likeAllName[] = $row_all;
                            }
                    
                     foreach ($likeAllName as $k => $v) {
                          $strName.= $likeAllName[$k]['User_Name'].', ';
                        
                      }
                           $uname = rtrim($strName, ', ');
                      
                                      
                        $sqlAll = 'UPDATE `discussions` SET `like_to_uname` = "'.$uname.'" WHERE `comment_id` = "'.$hozzid.'"'; 
                        if (mysqli_query($conn, $sqlAll)) {
                                    echo "Like inserted successfully";
                                } else {
                                    echo "Error: " . $sqlAll . "<br>" . mysqli_error($conn);
                                }
   
  
    }


   // NEGATIV AG (CSOKKENTES)-----------------------------------------------------------------------------------------------------------------------------------------------
        
        //ha a likeable == 1 ->(mar van olyan id) like_to_userid felulirasa es like csokkentese!
                 
        if ( ($likeable == 1) && (isset($user_id)) ) {
        
                      $arr=[];
                      foreach ($LikeUserIds as $k => $v) {
                      if ($v != $user_id){$arr[]=$v;}
                      }
                       
                      $newLikeUserIds = implode(",",$arr);
                      
  
    
                   //8. like_to_userid  felulirasa  (hozzaszolasok tablaba) ----------------------------------------------------------------------
          
                      $sql3 = 'UPDATE `discussions` SET `like_to_userid` =  "'.$newLikeUserIds.'" WHERE `comment_id` = "'.$hozzid.'"';
  
  
                      if (mysqli_query($conn, $sql3)) {
                          echo "UserId inserted successfully";
                      } else {
                          echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                      }
  
              
                  // 9. like csokkentese eggyel ----------------------------------------------------------------------------------------------------
  
                      $sql = 'UPDATE `discussions` SET `comment_like` = `comment_like` - 1 WHERE `comment_id` = "'.$hozzid.'"';
                       
                      if (mysqli_query($conn, $sql)) {
                          echo "Like inserted successfully";
                      } else {
                          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                      }
  
                   //nevek torlese (like_to_uname)-----------------------------------------------------------------------------------------------------
                        //itt a hiba!
                    
                          $string="";
             
                          $str_Ids = ltrim($newLikeUserIds, ',');
                          if ($str_Ids != ''){    //ha nem ures, csak akkor hajtsa vegre a lekerdezest 
                             
                                  $sql_del = 'SELECT `User_Name` FROM `users` WHERE `UserID` IN ('.$str_Ids.')';
            
                                  $resultAll = mysqli_query($conn,$sql_del);
                               
                                  if ($resultAll !='') {
                                  
                                      while ($row_all = $resultAll->fetch_assoc()){
                                          $like_Nams[] = $row_all;
                                          }
            
                                            $userNames = array();
                                            foreach ($like_Nams as $item) {
                                                $userNames[] = $item["User_Name"];
                                            }
                                            
                                          
                                               $string = implode(", ", $userNames);
                                        
                                   }        
                               
                                            
                                $sqlAllDel = 'UPDATE `discussions` SET `like_to_uname` = "'.$string.'" WHERE `comment_id` = "'.$hozzid.'"'; 
                                if (mysqli_query($conn, $sqlAllDel)) {
                                            echo "Like inserted successfully";
                                        } else {
                                            echo "Error: " . $sqlAllDel . "<br>" . mysqli_error($conn);
                                        }
                          }
           //-----------------------------------------------------------------------------------------------------------------------------------

} 
         
        $conn->close();
    
}


?>


