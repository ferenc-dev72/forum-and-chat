<?php


// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


                       
//itt a partner id-je kell, mert a header- reszben az inormaciok kellenek
$users_chats_id = isset($_GET['users_chats_id']) ? intval($_GET['users_chats_id']) : 0;

$sql = "SELECT uc.username, uc.last_active, ue.img_user 
        FROM users_chats uc
        JOIN users_extras ue ON uc.User_Hash = ue.User_Hash
        WHERE uc.users_chats_id = $users_chats_id";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $lastActive = strtotime($row['last_active']);
    $now = time();
    $diff = $now - $lastActive;

    // Ha a last_active a jövõben van, kezeljük ezt külön
    if ($diff < 0) {
        $timeAgo = '';     //in the future (check server time)
    } elseif ($diff < 60) {
        $timeAgo = 'just now';
    } elseif ($diff < 3600) {
        $timeAgo = floor($diff / 60) . ' minute(s) ago';
    } elseif ($diff < 86400) {
        $timeAgo = floor($diff / 3600) . ' hour(s) ago';
    } else {
        $timeAgo = floor($diff / 86400) . ' day(s) ago';
    }

    echo json_encode([
        'img_name' => $row['img_user'],
        'username' => $row['username'],
        'last_active' => $timeAgo
    ]);
} else {
    echo json_encode(['error' => 'User not found']);
}

$conn->close();

?>
