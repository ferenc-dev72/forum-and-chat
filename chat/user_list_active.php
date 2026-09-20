<?php

// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

header('Content-Type: application/json; charset=utf-8');

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed.']);
    exit;
}

// Define time threshold for online status
$threshold = date("Y-m-d H:i:s", strtotime('-5 minutes'));

// Get the filter parameter
$filter = $_GET['filter'] ?? '';

// Get users_chats_id parameter and validate
$users_chats_id = $_GET['uid'] ?? '';
if (!is_numeric($users_chats_id)) {
    echo json_encode(['error' => 'Invalid user ID.']);
    exit;
}

//------------------------------------------------------------------------------
// Check if the user exists
$sql4 = 'SELECT * FROM `users_chats` WHERE `users_chats_id` = ?';
$stmt4 = $conn->prepare($sql4);

if (!$stmt4) {
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$stmt4->bind_param("i", $users_chats_id);
$stmt4->execute();
$result4 = $stmt4->get_result();

$active_chats = '';
if ($row4 = $result4->fetch_assoc()) {
    $active_chats = $row4['active_chats'];
} else {
    echo json_encode(['error' => 'User not found.']);
    exit;
}

$stmt4->close();

// Split active_chats into an array
$activeIds = explode(",", $active_chats);
$activeIds = array_filter($activeIds, 'is_numeric'); // Ensure all IDs are numeric
if (empty($activeIds)) {
    echo json_encode([]); // Üres lista visszaadása
    exit;
}


$activeIdsPlaceholder = implode(",", array_fill(0, count($activeIds), "?"));

//------------------------------------------------------------------------------
// Base SQL query
$sql = "
    SELECT 
        uc.users_chats_id, 
        uc.username, 
        uc.last_active, 
        uc.chat_status, 
        ue.img_user,
        (SELECT COUNT(*) FROM messages 
         WHERE to_users_chats_id = ? 
         AND from_users_chats_id = uc.users_chats_id 
         AND is_read = 0) AS unread_count
    FROM users_chats uc
    JOIN users_extras ue ON uc.User_Hash = ue.User_Hash
    WHERE uc.users_chats_id != ?
    AND uc.users_chats_id IN ($activeIdsPlaceholder)
";

// If the filter is 'unread', add the HAVING clause
if ($filter == 'unread') {
    $sql .= " HAVING unread_count > 0";
}

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit;
}

// Bind parameters dynamically
$params = array_merge([$users_chats_id, $users_chats_id], $activeIds);
$stmt->bind_param(str_repeat("i", count($params)), ...$params);

$stmt->execute();
$result = $stmt->get_result();

$user_list = [];
while ($row = $result->fetch_assoc()) {
    // Determine online status
    $is_online = ($row['chat_status'] === 'open') && ($row['last_active'] >= $threshold);
    $has_unread = $row['unread_count'] > 0 ? 'message' : '';

    // Handle missing user image
    if (empty($row['img_user'])) {
        $row['img_user'] = 'forum_face_img.jpg';
    }

    $user_list[] = [
        'unread' => $has_unread,
        'users_chats_id' => $row['users_chats_id'],
        'username' => $row['username'],
        'status' => $is_online ? 'Online' : 'Offline',
        'img_name' => $row['img_user'] // Include the img_user data
    ];
}

echo json_encode($user_list);

?>
