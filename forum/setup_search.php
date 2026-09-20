


<?php

session_start();

// Kapcsolódás az adatbázishoz
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//----------ha nincs belépve a user egybol kilep--------------------------------

  if (!isset($_SESSION['User_Hash'])){
      exit();
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
//-------------------------------------------------------------------------------------------

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $sql = "SELECT UserID, User_Name, User_Email, User_Level FROM users WHERE User_Level=0 or User_Level=5 and User_Name LIKE '%$query%' LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<span>" . $row['UserID'] . " - <span style='color:orange;'>". $row['User_Name'] . "</span> - " . $row['User_Email'] . " - Level: " . $row['User_Level'] . "</span></span>";
            echo " &nbsp;&nbsp;";
            echo "&#10142;";
            echo " &nbsp;&nbsp;";
            echo "Update <input type='checkbox' class='user-level-checkbox' data-id='" . $row['UserID'] . "' " . ($row['User_Level'] == 5 ? "checked" : "") . ">";
            echo "</div>";
        }
    } else {
        echo "No match..";
    }
}

$conn->close();







//-----------------------------------------------------------------   
//}
?>