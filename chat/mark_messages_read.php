<?php


// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//------------------------------------------
 
/* 
 $sql2 = 'SELECT * FROM `users_chats` where `User_Hash` = "'.$hash.'"';
  
       $result2 = mysqli_query($con,$sql2);
       $user[]='';
       while ( $row2 = $result2->fetch_assoc() ){
               $user[] = $row2;
             }  
           //    $user_id = $users[1]['UserID'];

 $users_chats_id = $user['1']['users_chats_id'];

*/
$users_chats_id = $_POST['users_chats_id'];
$target_id = $_POST['targetUserId'];

//-----------------------------------------------

// Ellenõrizzük a felhasználó online státuszát
$sql_check_status = "
    SELECT chat_status 
    FROM users_chats 
    WHERE users_chats_id = ?
";

$stmt_check_status = $conn->prepare($sql_check_status);
if (!$stmt_check_status) {
    die("Prepare failed: " . $conn->error);
}

$stmt_check_status->bind_param("i", $users_chats_id);
$stmt_check_status->execute();
$result = $stmt_check_status->get_result();
$row = $result->fetch_assoc();

if ($row && $row['chat_status'] === 'open') {
    // Ha a felhasználó online, frissítsük az is_read mezõt
    $sql_update_read = "
        UPDATE messages 
        SET is_read = 1 
        WHERE to_users_chats_id = ? 
        AND from_users_chats_id = ? 
        AND is_read = 0
    ";

    $stmt_update_read = $conn->prepare($sql_update_read);
    if (!$stmt_update_read) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_update_read->bind_param("ii", $users_chats_id,$target_id);
    $stmt_update_read->execute();
    $stmt_update_read->close();
}

// Frissítsük a has_unread_messages mezõt
$sql_update_status = "
    UPDATE users_chats
    SET has_unread_messages = (
        SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
        FROM messages 
        WHERE to_users_chats_id = ? AND is_read = 0
    )
    WHERE users_chats_id = ?
";

$stmt_update_status = $conn->prepare($sql_update_status);
if (!$stmt_update_status) {
    die("Prepare failed: " . $conn->error);
}

$stmt_update_status->bind_param("ii", $users_chats_id, $users_chats_id);
$stmt_update_status->execute();

$stmt_check_status->close();
$stmt_update_status->close();
$conn->close();
?>

