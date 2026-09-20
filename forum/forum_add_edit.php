

<?php

//--------------------add Edit--------------------------------------------------
//---------------(user szerkesztheti a coommentjet)-----------------------------


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
  
//----------ha nem egyezik a belepett user es a commentalo user -> kilep--------

  if ( ($_SESSION['User_Hash']) != $_POST['userHash_commented']){
      exit();
  }
  
//------------------------------------------------------------------------------

if (isset($_POST['addEdit_comment']) &&  ($_POST['userHash_commented']!='' )  && (($_POST['comm_id']!='' )) )  {


//----------------UPDATE--------------------------------------------------------

// adatok begyujtese

    $addetitComment = $_POST['addEdit_comment'];
    $comm_id=$_POST['comm_id'];
    $localTime = $_POST['localTime'];  
    
    $t=time();
    $serverTimePhp = (date("Y-m-d H:i:s",$t));
    $addeditCommentEscaped='';
  
// update
 if ( (isset($_POST["addEdit_comment"])) && (!empty($_POST["addEdit_comment"]))  && (($_POST["addEdit_comment"]) != NULL )  ) {
    
    $addeditCommentEscaped = mysqli_real_escape_string($conn, $addetitComment);
    

    $sql_update = "UPDATE `discussions` SET `comment` = '$addeditCommentEscaped', `comment_date` = '$serverTimePhp', `comment_date_local` = '$localTime' WHERE `comment_id` = $comm_id";
 
 
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