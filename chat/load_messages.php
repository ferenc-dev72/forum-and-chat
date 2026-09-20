<?php

// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users_chats_id = $_GET['uid'];
$to_users_chats_id = $users_chats_id;
$from_users_chats_id = $_GET['to_users_chats_id'];

// Lekérdezés az utolsó elküldött üzenet ID-ja alapján
$last_message_id = isset($_GET['last_message_id']) ? intval($_GET['last_message_id']) : 0;

$sql2 = "SELECT message_id, message, is_read, timestamp, from_users_chats_id 
         FROM messages 
         WHERE ((from_users_chats_id = ? AND to_users_chats_id = ?) OR (from_users_chats_id = ? AND to_users_chats_id = ?))
         AND message_id > ?  -- Javítás: message_id használata
         ORDER BY timestamp ASC";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("iiiii", $to_users_chats_id, $from_users_chats_id, $from_users_chats_id, $to_users_chats_id, $last_message_id);
$stmt->execute();
$result = $stmt->get_result();


$messages = [];
$lastMessageId = $last_message_id; // Inicializálás a kapott értékkel

while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'id' => $row['message_id'], // message_id használata
        'message' => $row['message'],
        'is_read' => $row['is_read'],
        'timestamp' => $row['timestamp'],
        'from_users_chats_id' => $row['from_users_chats_id']
    ];
    $lastMessageId = $row['message_id']; // Frissítés minden új üzenettel
}



$response = [
    'messages' => $messages,
    'last_message_id' => $lastMessageId
];

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);


?>