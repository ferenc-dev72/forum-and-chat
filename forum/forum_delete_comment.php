

<?php
 session_start();
//------------------------------------------------------------------------------
//--------------------DELETE comments-------------------------------------------








//----------ha nincs belépve a user egybol kilep--------------------------------

  if (!isset($_SESSION['User_Hash'])){
      exit();
  }
//------------------------------------------------------------------------------
   

if (isset($_POST['comm_id']) &&  ($_POST['kepId']!='' )  )  {


// Kapcsolódás az adatbázishoz

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
   

//----------kép törlése (ha volt)-----------------------------------------------------
  $comm_id = $_POST['comm_id'];
  $sql_img_del = 'SELECT `upload_img` FROM `discussions` WHERE `comment_id` = "'.$comm_id.'"'; 
         $imgdel[]='';     
         if ($result_img_del = mysqli_query($conn, $sql_img_del)) {
            while ($row_img_del = $result_img_del->fetch_assoc()) {
                $imgdel = $row_img_del;
            } }
  
if (isset($imgdel['upload_img'])) {         //ha van kep, akkor torli
   if ( ($imgdel['upload_img']) != '' ) {
        $filename = $imgdel['upload_img'];
        
        //$filePath = __DIR__ . '/image/forum/upload_files/' . $filename;                   //Az aktuális fájl könyvtárának teljes útvonala
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/image/forum/upload_files/' . $filename;  // A weboldal gyökérkönyvtára
        
        if (is_writable($filePath)) {
            echo $filePath." is writable";
        } else {
            echo $filePath." is not writable";
        }
        
        //print_r($filePath);
        //die();  
        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            echo "File does not exist.";
        }
 }
} 

 //------- a torlendo-hez akik hozzaszoltak/-------------------------------------------------------    

     // adatok begyujtese   
    $comm_id = $_POST['comm_id'];
    $parent_commResults[]='';  
      $sql3 = 'SELECT `comment_id` FROM `discussions` WHERE `parent_id` = "'.$comm_id.'"'; 
         
        if ($result3 = mysqli_query($conn, $sql3)) {
            while ($row3 = $result3->fetch_assoc()) {
                $parent_commResults[] = $row3;
            } }
 
      $parentCommmid = array_column($parent_commResults, 'comment_id');
      $parentCommmid = implode(', ', $parentCommmid);
     
  
      
      //most meg nem toroljuk a hozza kapcsolodo hozzaszolasokat, de parent id -->0 lesz 
      //most nem irok be az edited tablaba sem!!!
     
     if (!empty($parentCommmid)) {
        $sql = "UPDATE `discussions` SET `parent_id` = '0' WHERE `comment_id` IN ($parentCommmid)";
          
        if (mysqli_query($conn, $sql)) {
                                   // echo "Successfully set the associated comments";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
           
     }


     
     




//----------------DELETE------------------------------------------------------------------------------
// Delete
if ( (isset($_POST["comm_id"])) && (!empty($_POST["comm_id"]))  && (($_POST["comm_id"]) != NULL )  ) {
    
      $sql_del =  'DELETE FROM `discussions` WHERE `comment_id` = "'.$comm_id.'"'; 
    
      if (mysqli_query($conn, $sql_del)) {
                  echo "<H3>Deleted successfully</H3>";
              } else {
                  echo "<H3>Error: </H3>" . $sql_del . "<br>" . mysqli_error($conn);
              }

}


//-------------------------------END-Delete comment-------------------------------

}

$conn->close();
?>