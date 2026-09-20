<?php
//echo "alma";
//die();

// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$users_chats_id = $_POST['users_chats_id'];
$status = $_POST['status'];

$sql = "UPDATE users_chats SET chat_status = ? WHERE users_chats_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $status, $users_chats_id);
$stmt->execute();

$stmt->close();
$conn->close();


?>
