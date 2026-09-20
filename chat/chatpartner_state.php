<?php

// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['uid'])) {
     $users_chats_id = $_POST['uid'];
      
      if (isset($_POST['targetUserId'])) {
          $targetUserId = $_POST['targetUserId'];
       }
    

    // Az aktív és archivált chat-ek lekérdezése
    $sql5 = 'SELECT active_chats, archived_chats FROM users_chats WHERE users_chats_id = ?';
    $stmt5 = $conn->prepare($sql5);

    if (!$stmt5) {
        die("Hiba a lekérdezés elõkészítésekor: " . $conn->error);
    }

    $stmt5->bind_param("i", $users_chats_id);
    $stmt5->execute();

    if (method_exists($stmt5, 'get_result')) {
        $result5 = $stmt5->get_result();

        if ($row5 = $result5->fetch_assoc()) {
            $active_chats = $row5['active_chats'] ?? '';
            $archived_chats = $row5['archived_chats'] ?? '';
        } else {
            die("Hiba: Az adott felhasználó nem található.");
        }
    } else {
        // Alternatív módszer, ha get_result nem érhetõ el
        $stmt5->bind_result($active_chats, $archived_chats);
        if (!$stmt5->fetch()) {
            die("Hiba: Az adott felhasználó nem található.");
        }
    }

    $stmt5->close();

    // Aktív és archivált azonosítók tömbökbe helyezése
    $activeIds = $active_chats ? explode(",", $active_chats) : [];
    $archivedIds = $archived_chats ? explode(",", $archived_chats) : [];

    $state = '';

    if (in_array($targetUserId, $activeIds)) {
        $state = 'active';
    }

    if (in_array($targetUserId, $archivedIds)) {
        $state = 'archived';
    }

    echo $state;
} else {
    echo 'Hiba van: Nem érkezett POST adat.';
}
?>
