

<?php
session_start();
//--------------------Forum INSERT----------------------------------------------
//---------------(az add panel commentjeinek insert-je)------------------------

 
  
 
 
 
//----------ha nincs belépve a user egybol kilep--------------------------------   
  if (!isset($_SESSION['User_Hash'])){
      exit();
  }
//------------------------------------------------------------------------------   
 
if ( ($_POST['szerzo']!='') &&  ($_POST['hozzaszolas']!='' ) &&  ($_POST['kepId']!='')  ) {

// Kapcsolódás az adatbázishoz

include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 //------------------INSERT --------------------------------------------------------------------------

// Az urlaprol erkezo adatok begyujtese
    $szerzo = $_POST['szerzo'];
    $hozzaszolas = $_POST['hozzaszolas'];
    $kepId = $_POST['kepId']; 
    $szuloHozzaszolasId = $_POST['szuloHozzaszolasId'];
    $userHash = $_POST['userHash'];
    $localTime = $_POST['localTime'];          
    $t=time();
    $serverTimePhp = (date("Y-m-d H:i:s",$t));

    $upload_img = $_POST['img_general_name'];
    $upload_img_path = $_POST['img_general_path']; 
 



// uj Hozzaszolas hozzaadasa az adatbazishoz
if ( (isset($_POST["hozzaszolas"])) && (!empty($_POST["hozzaszolas"]))  && (($_POST["hozzaszolas"]) != NULL )  ) {
    $query = "INSERT INTO discussions (img_id, username, comment, comment_date, comment_date_local ,parent_id, User_Hash, upload_img, upload_img_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
   

    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssssss", $kepId, $szerzo, $hozzaszolas, $serverTimePhp, $localTime, $szuloHozzaszolasId, $userHash, $upload_img, $upload_img_path);
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

?>