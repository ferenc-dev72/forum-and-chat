
<?php

//---------------USER_HASH-lekerese--------------------------------------------


    session_start();


  if (isset($_SESSION['User_Hash'])) 
 {
  echo $_SESSION['User_Hash'];     
 }    

   
?>