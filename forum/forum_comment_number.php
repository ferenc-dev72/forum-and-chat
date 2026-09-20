<?php

//-------Commentek szamanak kiirasa---------------------------------------------



 if  ($_POST['kepId']!='')  {
    
     $kepId = $_POST['kepId'];
    
    
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    
     $comment_number=0;
      $hozzaszolasok[]='';

    

    
    $sql = 'SELECT * FROM `discussions` WHERE `img_id` = "'.$kepId.'" ORDER BY `comment_id` ASC';
    
    
    if ($result = mysqli_query($conn, $sql)) {
        // Adatok kiolvasasa az eredmenybol
        while ($row = $result->fetch_assoc()) {
            $hozzaszolasok[] = $row;
        }}
    
      $comment_number = count($hozzaszolasok);
     
      if ($comment_number>0){$comment_number-=1;}
     
      echo 'Number of comments: '.$comment_number;
     
      


}

$conn->close();


?>