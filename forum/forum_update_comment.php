

<?php

//------------------------------------------------------------------------------
//--------------------UPDATE comments-------------------------------------------




// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



//----------ha nincs belépve a user egybol kilep--------------------------------

  if (!isset($_SESSION['User_Hash'])){
      exit();
  }
//------------------------------------------------------------------------------

if (isset($_POST['update_comment']) &&  ($_POST['kepId']!='' )  && (($_POST['comm_id']!='' )) )  {




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
  
           $editorName = $user_lev['1']['User_Name']; //itt kinyerjuk a usernevet is!
  
  
       }else{
           echo 'You do not have permission to edit';
           exit();
       }
        
 }



//----------------UPDATE--------------------------------------------------------

// adatok begyujtese
    // $editorName = "Fera";
   // $editorName = $user['User_Name'];
    $updateComment = $_POST['update_comment'];
  //  $imgId = $_POST['kepId']; 
    $comm_id=$_POST['comm_id'];
 //   $parentId = 0;
  //  $userHash = $_SESSION['User_Hash'];
   // $localTime = $_POST['localTime'];  
    
    $t=time();
    $serverTimePhp = (date("Y-m-d H:i:s",$t));
    $updateCommentEscaped='';
    $editorNameEscaped='';


// update
 if ( (isset($_POST["update_comment"])) && (!empty($_POST["update_comment"]))  && (($_POST["update_comment"]) != NULL )  ) {
    
    $updateCommentEscaped = mysqli_real_escape_string($conn, $updateComment);
    $editorNameEscaped = mysqli_real_escape_string($conn, $editorName);

    $sql_update = "UPDATE `discussions` SET `comment` = '$updateCommentEscaped', `editor_name` = '$editorNameEscaped', `edited_time` = '$serverTimePhp' WHERE `comment_id` = $comm_id";
 
 
                        if (mysqli_query($conn, $sql_update)) {
                                    echo "<H3>Comment updated successfully</H3>";
                                } else {
                                    echo "<H3>Error: </H3>" . $sql_update . "<br>" . mysqli_error($conn);
                                }

 }

}

//-------------------------------END-Update comment-------------------------------



$conn->close();
?>