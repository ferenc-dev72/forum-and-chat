
<?php

//------------------USERNAME kiirasa ------------------------------------------- 
//-----------------(ha nincs belepve: Guest) ------------------------------------




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
     


      $sql2 = 'SELECT * FROM `users` where `User_Hash` = "'.$hash.'"';

 
       $result2 = mysqli_query($conn,$sql2);
       $user[]='';
       while ( $row2 = $result2->fetch_assoc() ){
               $user[] = $row2;
             }  
           //    $user_id = $users[1]['UserID'];
   
     if (isset($user['1']['User_Name'])){print_r($user['1']['User_Name']);}
     else {echo 'anonymus';}  
      
  }
   else{       
       
       echo "Guest";
   }

$conn->close();
?>