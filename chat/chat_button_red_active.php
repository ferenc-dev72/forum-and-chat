<?php

// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['User_Hash'])) {
    $hash = $_SESSION['User_Hash'];                    

    // Az active_chats kiolvasása
    $sql4 = "SELECT active_chats FROM `users_chats` WHERE `User_Hash` = ?";
    $activeIds = [];

    if ($stmt = $conn->prepare($sql4)) {
        $stmt->bind_param("s", $hash);
        $stmt->execute();
        $result4 = $stmt->get_result();

        if ($row4 = $result4->fetch_assoc()) {
            $active_chats = $row4['active_chats'];
            $activeIds = $active_chats ? explode(",", $active_chats) : [];
        } else {
            die("Nincs ilyen felhasználó az adatbázisban.");
        }
        $stmt->close();
    }

    // Ha vannak active ID-k
    if (!empty($activeIds)) {
        // Az ID-kat helyettesítõk hozzáadásával egy lekérdezéshez megfelelõ formátumúvá alakítjuk
        $placeholders = implode(",", array_fill(0, count($activeIds), "?"));
     
        $sql = "
            SELECT COUNT(*) as unread_count
            FROM messages
            JOIN users_chats ON messages.to_users_chats_id = users_chats.users_chats_id
            WHERE messages.is_read = 0
            AND users_chats.User_Hash = ?
            AND messages.from_users_chats_id IN ($placeholders);
        ";

        if ($stmt = $conn->prepare($sql)) {
            // Paraméterek összekapcsolása (hash + activeIds)
            $params = array_merge([$hash], $activeIds);
            $types = str_repeat("i", count($params)); // Minden paraméter integer
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
    } else {
       // echo "Nincsenek aktív ID-k az active_chats oszlopban.";   
        echo "unread count: ";
         print_r($unread_count);        
    }
}

$conn->close();
?>
