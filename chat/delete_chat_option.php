<?php
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["uid"]) && isset($_POST["targetUserId"])) {
    $uid = $conn->real_escape_string($_POST["uid"]);
    $targetUserId = $conn->real_escape_string($_POST["targetUserId"]);

    $sql4 = "SELECT * FROM `users_chats` WHERE `users_chats_id` = ?";
    $stmt = $conn->prepare($sql4);
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result4 = $stmt->get_result();

    if (!$result4 || !$row4 = $result4->fetch_assoc()) {
        die(json_encode(['status' => 'error', 'message' => 'Nincs ilyen felhasználó.']));
    }

    $archived_chats = $row4['archived_chats'];
    $active_chats = $row4['active_chats'];
    $deleted_chats = $row4['deleted_chats'];

    $archivedIds = $archived_chats ? array_filter(explode(",", $archived_chats)) : [];
    $activeIds = $active_chats ? array_filter(explode(",", $active_chats)) : [];
    $deletedIds = $deleted_chats ? array_filter(explode(",", $deleted_chats)) : [];

    $deletable = '';
    if (in_array($targetUserId, $archivedIds)) $deletable = 'archived';
    if (in_array($targetUserId, $activeIds)) $deletable = 'active';

    if ($deletable == 'active') {
        $updatedActiveIds = array_diff($activeIds, [$targetUserId]);
        $newActiveChats = implode(",", $updatedActiveIds);
        updateChatList($conn, 'active_chats', $newActiveChats, $uid);
    }

    if ($deletable == 'archived') {
        // Távolítsd el az archived_chats oszlopból
        $updatedArchivedIds = array_diff($archivedIds, [$targetUserId]);
        $newArchivedChats = implode(",", $updatedArchivedIds);
        updateChatList($conn, 'archived_chats', $newArchivedChats, $uid);

        // Add hozzá a deleted_chats oszlophoz
        if (!in_array($targetUserId, $deletedIds)) {
            $deletedIds[] = $targetUserId;
            $newDeletedChats = implode(",", $deletedIds);
            updateChatList($conn, 'deleted_chats', $newDeletedChats, $uid);
        }
    }
}

function updateChatList($conn, $columnName, $updatedList, $uid) {
    $sql = "UPDATE `users_chats` SET `$columnName` = ? WHERE `users_chats_id` = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $updatedList, $uid);
        if (!$stmt->execute()) {
            die(json_encode(['status' => 'error', 'message' => "Hiba a $columnName frissítése során: " . $stmt->error]));
        }
        $stmt->close();
    } else {
        die(json_encode(['status' => 'error', 'message' => 'Hiba az SQL elõkészítése során.']));
    }
}

$conn->close();
?>
