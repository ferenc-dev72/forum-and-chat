<?php
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 if ($_POST['send_commit']) {
 

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



//--------------------------------------------------------------------------------
//------------------------------------------------------------------------------  
//kepek beolvasasa az adatbazisbol
$sql = "SELECT upload_img FROM discussions WHERE upload_img <> ''";
$result = $conn->query($sql);

$db_images = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $db_images[] = $row['upload_img'];
    }
}

//print_r($db_images);
//echo 'db_images '.count($db_images);




//a mappaban talalhato kepek ------------------------------------------------------
$folder_path = 'upload_files/';
$folder_images = array_diff(scandir($folder_path), array('.', '..'));

//print_r($folder_images);
//echo 'folder '.count($folder_images);




//------------torles-------------------------------------------------------------
$img_unuse=[];
//kepek torlese, amik nincsenek az adatbazisban
foreach ($folder_images as $image) {
    if (!in_array($image, $db_images)) {
       $img_unuse[]=$folder_path . $image;
       unlink($folder_path . $image);
    }
}
   $img_numb=count($db_images);
   $folder_numb=count($folder_images);
  
  
echo $img_numb.'- in database' . "\n";             
echo $folder_numb.'- in folder' . "\n"; 
echo ' --> ' . "\n"; 
echo count($img_unuse).' deleted file(s)!' . "\n";



}


$conn->close();
?>