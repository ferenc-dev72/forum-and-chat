<?php
// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_SESSION['User_Hash'])){
    exit();
}



if (isset($_POST['kepId'])) {
    $kepId = $_POST['kepId'];
    $uHash = $_SESSION['User_Hash'];

    // Aktuális idõpont meghatározása a szerveren
    $currentTime = date("Y-m-d H:i:s");
    $tenMinutesAgo = date("Y-m-d H:i:s", strtotime('-10 minutes'));

    // Utolsó ellenõrzés idõpontjának lekérdezése
    if (isset($_SESSION['last_check_time'])) {
        $last_check_time = $_SESSION['last_check_time'];
    } else {
        $last_check_time = $tenMinutesAgo;
    }

    // Új kommentek lekérdezése az utolsó ellenõrzés óta
    $sql = 'SELECT COUNT(*) as new_comments FROM `discussions` WHERE `img_id` = ? AND `User_Hash` <> ? AND `comment_date` > ? ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $kepId, $uHash, $last_check_time);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['new_comments'] > 0) {
        echo "<span style='font-size: 14px;'>New Comment</span><span style='font-size: 12px;color:lightgray';>&nbsp;&nbsp;(in last 10 min)</span>";
    }

    // Utolsó ellenõrzés idõpontjának frissítése
    $_SESSION['last_check_time'] = $currentTime;
}



$conn->close();
?>
