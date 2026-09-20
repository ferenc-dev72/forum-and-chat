<?php
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ellenõrzés, hogy az adatok beérkeztek-e
if (isset($_POST["uid"]) && isset($_POST["targetUserId"])) {
    $uid = $conn->real_escape_string($_POST["uid"]);
    $targetUserId = $conn->real_escape_string($_POST["targetUserId"]);

    // Ellenõrzés, volt-e már ilyen ID
    $sql4 = 'SELECT * FROM `users_chats` WHERE `users_chats_id` = "'.$uid.'"';
    $result4 = mysqli_query($conn, $sql4);

    if (!$result4) {
        die("Hiba a lekérdezés során: " . mysqli_error($conn));
    }

    $row4 = $result4->fetch_assoc();
    if (!$row4) {
        die("Nincs ilyen felhasználó.");
    }

    $archived_chats = $row4['archived_chats'];
    $active_chats = $row4['active_chats'];

    $archivedIds = explode(",", $archived_chats);

    // Ha a $targetUserId már az archived_chats-ben van, akkor kilépünk
    if (in_array($targetUserId, $archivedIds)) {
        die("Ez az ID már archiválva van.");
    }

    // Az archived_chats frissítése
    $sql3 = "UPDATE `users_chats` 
             SET `archived_chats` = CONCAT(`archived_chats`, ',', ?) 
             WHERE `users_chats_id` = ?";

    if ($stmt = $conn->prepare($sql3)) {
        $stmt->bind_param("ss", $targetUserId, $uid);

        if (!$stmt->execute()) {
            die("Hiba a frissítés során: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Hiba az SQL elõkészítése során: " . $conn->error);
    }

    // Az active_chats frissítése: eltávolítjuk a $targetUserId értéket
    $activeIds = array_filter(explode(",", $active_chats)); // Eltávolítjuk az üres elemeket
    $updatedActiveIds = array_diff($activeIds, [$targetUserId]); // Eltávolítjuk a $targetUserId-t
    $newActiveChats = implode(",", $updatedActiveIds); // Új lista összeállítása

    $sql5 = "UPDATE `users_chats` SET `active_chats` = ? WHERE `users_chats_id` = ?";

    if ($stmt = $conn->prepare($sql5)) {
        $stmt->bind_param("ss", $newActiveChats, $uid);

        if (!$stmt->execute()) {
            die("Hiba az active_chats frissítése során: " . $stmt->error);
        }

        echo "Frissítés sikeres.";
        $stmt->close();
    } else {
        die("Hiba az SQL elõkészítése során: " . $conn->error);
    }
}

// Kapcsolat lezárása
$conn->close();
?>
