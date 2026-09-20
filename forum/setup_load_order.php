<?php

//-------Commentek sorrendjenek betoltese---------------------------------------------

    
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    
    
    $comm_order[]='';
   
    $sql = 'SELECT `load_image_order` FROM `discussions_setup`';
    
    
    if ($result = mysqli_query($conn, $sql)) {
        // Adatok kiolvasasa az eredmenybol
        while ($row = $result->fetch_assoc()) {
            $comm_order[] = $row;
        }}
    
      $comment_order = $comm_order['1']['load_image_order'];
    
     
      echo $comment_order;
     

$conn->close();


?>