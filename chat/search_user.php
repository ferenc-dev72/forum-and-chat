<?php


// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define time threshold for online status
$threshold = date("Y-m-d H:i:s", strtotime('-5 minutes'));

$query = $_GET['query'] ?? ''; // Get the search query

// Ha a keresés túl rövid, ne térjünk vissza minden felhasználóval
if (strlen($query) < 2) {
    echo json_encode([]); // Üres lista, ha nincs értelmes keresés
    exit;
}

$users_chats_id='';
if ($_GET['uid']) {$users_chats_id = $_GET['uid'];}

//------------------------------------------------------------------------------
//Azok a userek, akik mar kuldtek uzenetet ($sql_mess)
//------------------------------------------------------------------
$sql_mess = " 
SELECT DISTINCT 
   `from_users_chats_id`
       FROM 
         `messages` 
            WHERE 
              `to_users_chats_id` = ?
";

$stmt_mess = $conn->prepare($sql_mess);

if (!$stmt_mess) {
    die("Prepare failed: " . $conn->error);
}

$stmt_mess->bind_param("i", $users_chats_id);
$stmt_mess->execute();
$result_mess = $stmt_mess->get_result();

$user_arch_mess = [];
while ($row = $result_mess->fetch_assoc()) {
    $user_arch_mess[] = $row['from_users_chats_id'];
}

// Az eredmény-tömb formázása SQL-ben használható formátumra
$user_arch_mess_sql = implode(", ", $user_arch_mess);


//------------------------------------------------------------------

// Prepare the SQL query with JOIN to search users by name, and join with users_extras
$sql = "
    SELECT 
        uc.users_chats_id, 
        uc.username, 
        uc.last_active, 
        uc.chat_status, 
        ue.img_user,
        (SELECT COUNT(*) FROM messages 
         WHERE to_users_chats_id = ? 
 
         AND from_users_chats_id IN (2,3)
         AND from_users_chats_id = uc.users_chats_id 
         AND is_read = 0) AS unread_count
    FROM users_chats uc
    JOIN users_extras ue ON uc.User_Hash = ue.User_Hash
    WHERE uc.users_chats_id != ? 
    AND uc.users_chats_id IN ($user_arch_mess_sql) 
    AND uc.username LIKE ?
    LIMIT 5
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind the parameters
$likeQuery = '%' . $query . '%';
$stmt->bind_param("iis", $users_chats_id, $users_chats_id, $likeQuery);
$stmt->execute();
$result = $stmt->get_result();

$user_list = [];
while ($row = $result->fetch_assoc()) {
    // Determine online status
    $is_online = ($row['chat_status'] === 'open') && ($row['last_active'] >= $threshold);
    $has_unread = $row['unread_count'] > 0 ? 'message' : '';
    
    // Handle missing user image
    if ($row['img_user'] == '') {
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
