 <?php
 
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  if (isset($_SESSION['User_Hash'])) 
 {
      $uhash=$_SESSION['User_Hash'];
     // $tuId= $_POST['tuid'];
       
   $sql = "
              SELECT *
              FROM users_chats
              WHERE User_Hash = ? ;
          ";

$stmt = $conn->prepare($sql);
// Paraméterek kötése az 1. lekérdezéshez
$stmt->bind_param("i", $uhash);
$stmt->execute();
$result = $stmt->get_result();


// Felhasználói lista létrehozása

$deleted_chats='';
while ($row = $result->fetch_assoc()) {
      $deleted_chats=$row['deleted_chats'];

}
$deleted=array();
$deleted = explode(",",$deleted_chats);


print_r($deleted);






}        
     //  echo "Guest";
$conn->close();   
?>