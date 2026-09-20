
<?php

//------------------Main Input IMG ------------------------------------------- 
//-----------------(avatar: ha nincs belepve: alapkep) -----------------------------




/*
     //input megtisztitasa (most csak java oldalon van)
     
function cleanLogin($resultLogin) {
    $pattern = "/[^\x20-\x7E]/";  // Regular expression pattern
    $cleanLogin = preg_replace($pattern, '', $resultLogin);

    return trim($cleanLogin);
}

$resultLogin = "Guest";  // Assuming the value is coming from a database or other source
$resultLogin = cleanLogin($resultLogin);

*/


// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  if (isset($_SESSION['User_Hash'])) 
 {
      $hash=$_SESSION['User_Hash'] ;
     
     

      $sql_x = 'SELECT * FROM `users_extras` where `User_Hash` = "'.$hash.'"';

 
       $result2 = mysqli_query($conn,$sql_x);
       $user_x[]='';
       while ( $row_x = $result2->fetch_assoc() ){
               $user_x[] = $row_x;
             }  
           //    $user_id = $users[1]['UserID'];
   
      if ( ($user_x['1']['img_user']) != '') {
          print_r($user_x['1']['img_user']);
      }else{
          echo "forum_face_img.jpg";
      } 
       

} else {echo "forum_face_img.jpg";}
       
       
     



$conn->close();   
?>