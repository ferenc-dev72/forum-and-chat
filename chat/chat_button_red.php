<?php
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['User_Hash'])) {
    $hash = $_SESSION['User_Hash'];

    // Az archived_chats kiolvasása
    $sql1 = "SELECT archived_chats FROM `users_chats` WHERE `User_Hash` = ?";
    $archivedIds = [];

    if ($stmt = $conn->prepare($sql1)) {
        $stmt->bind_param("s", $hash);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $archived_chats = $row['archived_chats'];
            $archivedIds = $archived_chats ? explode(",", $archived_chats) : [];
        }
        $stmt->close();
    }

    // A deleted_chats kiolvasása
    $sql2 = "SELECT deleted_chats FROM `users_chats` WHERE `User_Hash` = ?";
    $deletedIds = [];

    if ($stmt = $conn->prepare($sql2)) {
        $stmt->bind_param("s", $hash);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $deleted_chats = $row['deleted_chats'];
            $deletedIds = $deleted_chats ? explode(",", $deleted_chats) : [];
        }
        $stmt->close();
    }

    // Összes kizárt ID összefésülése
    $allExcludedIds = array_merge($archivedIds, $deletedIds);

    // Alap SQL
    $sql = "
        SELECT COUNT(*) as unread_count
        FROM messages
        JOIN users_chats ON messages.to_users_chats_id = users_chats.users_chats_id
        WHERE messages.is_read = 0
        AND users_chats.User_Hash = ?
    ";

    // Ha vannak kizárt ID-k, adjuk hozzá a NOT IN feltételt
    if (!empty($allExcludedIds)) {
        $placeholders = implode(",", array_fill(0, count($allExcludedIds), "?"));
        $sql .= " AND messages.from_users_chats_id NOT IN ($placeholders)";
    }

    // SQL elõkészítése és paraméterek hozzárendelése
    if ($stmt = $conn->prepare($sql)) {
        $params = [$hash];
        $types = "s";

        if (!empty($allExcludedIds)) {
            $params = array_merge($params, $allExcludedIds);
            $types .= str_repeat("i", count($allExcludedIds)); // ID-k integer típusúak
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        $unread_count = 0;
        if ($row = $result->fetch_assoc()) {
            $unread_count = $row['unread_count'];
        }

         print_r($unread_count); 

        $stmt->close();
    }
}

$conn->close();
?>
