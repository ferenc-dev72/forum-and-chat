

<?php
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//----------------USER_LEVEL ellenorzese------------------------------------------------------
   
  if (isset($_SESSION['User_Hash'])) 
 {
  
         $hash = $_SESSION['User_Hash'];
        // Kapcsolat ellenorzese
       
    $sql_lev = 'SELECT * FROM `users` where `User_Hash` = "'.$hash.'"';
 
       $result_lev = mysqli_query($conn,$sql_lev);
       $user_lev[]='';
       while ( $row_lev = $result_lev->fetch_assoc() ){
               $user_lev[] = $row_lev;
             }  
      
       $level_enable='';
    
       if ( ($user_lev['1']['User_Level'] == 1) || ($user_lev['1']['User_Level'] == 5)    ) {
             $level_enable='ok';
       }else{
           echo 'You do not have permission to edit';
           exit();
       }
        
 }

 
 
//----------ha nincs belépve a user egybol kilep--------------------------------   
  if (!isset($_SESSION['User_Hash'])){
      exit();
  }
//------------------------------------------------------------------------------   

if (isset($_POST['userId']) && isset($_POST['userLevel'])) {
    $id = $_POST['userId'];
    $user_level = $_POST['userLevel'];
    $sql = "UPDATE users SET User_Level = $user_level WHERE UserID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "User Level Updated!";
    } else {
        echo "Error occurred: " . $conn->error;
    }
}

$conn->close();
?>

