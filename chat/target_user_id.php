 <?php
 
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  
  if ($_POST['userHash_chat']) 
 {
      $target_hash = $_POST['userHash_chat'] ;
     
      

      $sql2 = 'SELECT * FROM `users_chats` where `User_Hash` = "'.$target_hash.'"';

 
       $result2 = mysqli_query($conn,$sql2);
       $user[]='';
       while ( $row2 = $result2->fetch_assoc() ){
               $user[] = $row2;
             }  
           //    $user_id = $users[1]['UserID'];
   
       //print_r($user['1']['users_chats_id']);
       
       print_r($user['1']['users_chats_id']);
       
       //die();
}
       
       
     //  echo "Guest";
$conn->close();   
?>