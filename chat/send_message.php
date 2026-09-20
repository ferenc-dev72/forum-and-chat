<?php

// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = $_POST['message'];
$to_users_chats_id = $_POST['to_users_chats_id'];
$users_chats_id = $_POST['uid'];

// Próbáljuk beszúrni az üzenetet
$sql_insert = "
    INSERT INTO messages (from_users_chats_id, to_users_chats_id, message, is_read, timestamp)
    VALUES (?, ?, ?, 0, NOW())
";

$stmt_insert = $conn->prepare($sql_insert);
if (!$stmt_insert) {
    die("Prepare failed: " . $conn->error);
}

$stmt_insert->bind_param("iis", $users_chats_id, $to_users_chats_id, $message);

// Duplikálás hiba kezelése
if (!$stmt_insert->execute()) {
    if ($conn->errno == 1062) {
        // Duplikációs hiba, nem csinál semmit
        echo "Ez az üzenet már létezik.";
    } else {
        die("Hiba történt: " . $conn->error);
    }
} else {
    // Frissítsük a címzett olvasatlan üzenet státuszát
    $sql_update_status = "
        UPDATE users_chats
        SET has_unread_messages = 1
        WHERE users_chats_id = ?
    ";
    $stmt_update_status = $conn->prepare($sql_update_status);
    if (!$stmt_update_status) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_update_status->bind_param("i", $to_users_chats_id);
    $stmt_update_status->execute();
    $stmt_update_status->close();
}

$stmt_insert->close();
$conn->close();


?>