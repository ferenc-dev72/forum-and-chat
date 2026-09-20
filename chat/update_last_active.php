
 <?php

 // Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (isset($_POST['users_chats_id'])) {
    $users_chats_id = $_POST['users_chats_id'];



    $stmt = $conn->prepare("UPDATE users_chats SET last_active = NOW() WHERE users_chats_id = ?");
    $stmt->bind_param("i", $users_chats_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
