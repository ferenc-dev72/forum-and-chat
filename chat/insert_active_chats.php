<?php 
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ellenõrzés, hogy az adatok beérkeztek-e
if (isset($_POST["uid"]) && isset($_POST["users_chats_id"])) {
    $uid = $conn->real_escape_string($_POST["uid"]);
    $users_chats_id = $conn->real_escape_string($_POST["users_chats_id"]);

    // Ellenõrzés, hogy volt-e már ilyen ID
    $sql4 = "SELECT * FROM `users_chats` WHERE `users_chats_id` = ?";
    if ($stmt = $conn->prepare($sql4)) {
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result4 = $stmt->get_result();

        if ($row4 = $result4->fetch_assoc()) {
            $active_chats = $row4['active_chats'];
            $deleted_chats = $row4['deleted_chats'];
        } else {
            die("Nincs ilyen felhasználó az adatbázisban.");
        }
        $stmt->close();
    }

    $activeIds = $active_chats ? explode(",", $active_chats) : [];
    $deletedIds = $deleted_chats ? explode(",", $deleted_chats) : [];

    // Ha már benne van az active_chats oszlopban, nem kell semmit csinálni
    if (in_array($users_chats_id, $activeIds)) {
        die();
    }

    // Frissítés: hozzáadás az active_chats oszlophoz
    $sql3 = "UPDATE `users_chats` 
             SET `active_chats` = CONCAT(`active_chats`, ',', ?) 
             WHERE `users_chats_id` = ?";
    if ($stmt = $conn->prepare($sql3)) {
        $stmt->bind_param("ss", $users_chats_id, $uid);

        if ($stmt->execute()) {
            echo "Frissítés sikeres.";
        } else {
            echo "Hiba a frissítés során: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Hiba az SQL elõkészítése során: " . $conn->error;
    }

    // Törlés a deleted_chats oszlopból (ha benne van)
    if (in_array($users_chats_id, $deletedIds)) {
        $updatedDeletedIds = array_diff($deletedIds, [$users_chats_id]);
        $newDeletedChats = implode(",", $updatedDeletedIds);

        $sql5 = "UPDATE `users_chats` SET `deleted_chats` = ? WHERE `users_chats_id` = ?";
        if ($stmt = $conn->prepare($sql5)) {
            $stmt->bind_param("ss", $newDeletedChats, $uid);

            if ($stmt->execute()) {
                echo "Törlés a deleted_chats oszlopból sikeres.";
            } else {
                echo "Hiba a törlés során: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Hiba az SQL elõkészítése során: " . $conn->error;
        }
    }
}

// Kapcsolat lezárása
$conn->close();
?>
