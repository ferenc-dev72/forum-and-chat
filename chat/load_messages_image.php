<?php

// Kapcsol�d�s az adatb�zishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users_chats_id = $_GET['uid'];
$to_users_chats_id = $users_chats_id;
$from_users_chats_id = $_GET['to_users_chats_id'];

// Lek�rdez�s az utols� elk�ld�tt �zenet ID-ja alapj�n
$last_message_id_image = isset($_GET['last_message_id_image']) ? intval($_GET['last_message_id_image']) : 0;

$sql2 = "SELECT message_id, message, is_read, timestamp, from_users_chats_id 
         FROM messages 
         WHERE ((from_users_chats_id = ? AND to_users_chats_id = ?) OR (from_users_chats_id = ? AND to_users_chats_id = ?))
         AND message_id > ?  -- Jav�t�s: message_id haszn�lata
         ORDER BY timestamp ASC";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("iiiii", $to_users_chats_id, $from_users_chats_id, $from_users_chats_id, $to_users_chats_id, $last_message_id_image);
$stmt->execute();
$result = $stmt->get_result();


$messages = [];
$lastMessageId_image = $last_message_id_image; // Inicializ�l�s a kapott �rt�kkel

while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'id' => $row['message_id'], // message_id haszn�lata
        'message' => $row['message'],
        'is_read' => $row['is_read'],
        'timestamp' => $row['timestamp'],
        'from_users_chats_id' => $row['from_users_chats_id']
    ];
    $lastMessageId_image = $row['message_id']; // Friss�t�s minden �j �zenettel
}



$response = [
    'messages' => $messages,
    'last_message_id_image' => $lastMessageId_image
];

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);


?>