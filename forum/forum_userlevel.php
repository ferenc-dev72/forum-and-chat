
<?php

//---------------USER_LEVEL-lekerese--------------------------------------------

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

       print_r($user['1']['User_Level']);
       die();
}   // ----ha be volt lepve, akkor kiirja a level-t, ha nem akkor ures (echo "") 
       
       echo "";



$conn->close();   
?>