

<?php

//---------------------BASE Comment -INSERT ------------------------------------
//------------------(Ez az alap komment input)----------------------------------





 session_start();
 /*
  if ($_POST['editorContent']){
 echo $_POST['editorContent'];
 }   
 else{
 echo "kocsog";
 }
   die();
*/ 
 
//----------------ha nincs belepve a user -> egybol kilepes --------------------  
  if (!isset($_SESSION['User_Hash'])){
      exit();
  }
//------------------------------------------------------------------------------ 
  

if (isset($_POST['base_comment']) && $_POST['kepId']!='' ) {

// Kapcsolódás az adatbázishoz

include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 //-------user adatok lekerese /hash alapjan - users table/----------------------------------------------
 
 if (isset($_SESSION['User_Hash'])){   // csak ha be van lepve, akkor fut le   
       
    $sql2 = 'SELECT * FROM `users` where `User_Hash` = "'.$_SESSION['User_Hash'].'"';
        
    if ($result2 = mysqli_query($conn, $sql2)) {
        while ($row2 = $result2->fetch_assoc()) {
               $user = $row2;
           } }

 }    

 /*  
function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}
   */

 //-------------------Base INSERT --------------------------------------------------------------------------

// adatok begyujtese
    $userName = $user['User_Name'];
    $baseComment = $_POST['base_comment'];
    $imgId = $_POST['kepId']; 
    $parentId = 0;
    $userHash = $_SESSION['User_Hash'];
    $localTime = $_POST['localTime'];  
    $upload_img=$_POST['imageName']; 
    $upload_img_path=$_POST['imagePath']; 
 
    $t=time();
    $serverTimePhp = (date("Y-m-d H:i:s",$t));
 


// uj Hozzaszolas hozzaadasa az adatbazishoz
if ( (isset($_POST["base_comment"])) && (!empty($_POST["base_comment"]))  && (($_POST["base_comment"]) != NULL )  ) {
    $query = "INSERT INTO discussions (img_id, username, comment, comment_date, comment_date_local, parent_id, User_Hash, upload_img, upload_img_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
   

    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssssss", $imgId, $userName, $baseComment, $serverTimePhp, $localTime ,$parentId, $userHash, $upload_img, $upload_img_path);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Hozzaszolas sikeresen hozzaadva!";
    } else {
        echo "Hiba tortent a Hozzaszolas hozzaadasakor.";
    }


 
    $stmt->close();
    $conn->close();

}

}

//-------------------------------END-Base comment insert-------------------------------



?>