


<?php
//Az SQL lekérdezés módosításával és az ellenõrzések integrálásával elérhetjük,
// hogy az eredmény csak akkor jelenjen meg, ha a felhasználó nincs a 
// $activeIds és $archivedIds listákban. Az alábbiakban egy biztonságosabb,
//  paraméterezett SQL lekérdezést használunk, amely PHP IN operátort alkalmaz

//Az array_merge segítségével egyesítjük az összes paramétert.
//A str_repeat generálja a dinamikus számú ? helyettesítõket.
//Az activeIds és archivedIds tömbök tartalmát dinamikusan adjuk a lekérdezéshez.
//A NOT IN operátor gondoskodik arról, hogy az azonosítók ne szerepeljenek a megadott


// Kapcsolódás az adatbázishoz
session_start();
include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Idõ küszöb definiálása az online státuszhoz
$threshold = date("Y-m-d H:i:s", strtotime('-5 minutes'));

$filter = $_GET['filter'] ?? ''; // Szûrõ paraméter lekérése

$users_chats_id = '';
if (isset($_GET['uid'])) {
    $users_chats_id = $_GET['uid'];
}

// Az aktív és archivált chat-ek lekérdezése-------------------------------------
$sql5 = 'SELECT active_chats, archived_chats FROM users_chats WHERE users_chats_id = ?';
$stmt5 = $conn->prepare($sql5);
$stmt5->bind_param("i", $users_chats_id);
$stmt5->execute();
$result5 = $stmt5->get_result();

$active_chats = '';
$archived_chats = '';
if ($row5 = $result5->fetch_assoc()) {
    $active_chats = $row5['active_chats'];
    $archived_chats = $row5['archived_chats'];
} else {
    die(json_encode([])); // Ha a felhasználó nem található, üres eredmény
}

$stmt5->close();

// Aktív és archivált azonosítók tömbökbe helyezése
$activeIds = explode(",", $active_chats);
$archivedIds = explode(",", $archived_chats);
//------------------------------------------------------------------------------


// 1. LEKÉRDEZÉS VÉGREHAJTÁSA
$sql = "
    SELECT 
        uc.users_chats_id, 
        uc.username, 
        uc.last_active, 
        uc.chat_status, 
        ue.img_user,
        uc.User_Hash,
        (SELECT COUNT(*) FROM messages 
         WHERE to_users_chats_id = ? 
         AND from_users_chats_id = uc.users_chats_id 
         AND is_read = 0) AS unread_count
    FROM users_chats uc
    JOIN users_extras ue ON uc.User_Hash = ue.User_Hash
    WHERE uc.users_chats_id != ?
";

if ($filter == 'unread') {
    $sql .= " HAVING unread_count > 0";
}

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Paraméterek kötése az 1. lekérdezéshez
$stmt->bind_param("ii", $users_chats_id, $users_chats_id);
$stmt->execute();
$result = $stmt->get_result();

// Felhasználói lista létrehozása
$user_list = [];
while ($row = $result->fetch_assoc()) {
    // Csak azokat adjuk hozzá, akik nincsenek az aktív vagy archivált listában
    if (!in_array($row['users_chats_id'], $activeIds) && !in_array($row['users_chats_id'], $archivedIds)) {
        $is_online = ($row['chat_status'] === 'open') && ($row['last_active'] >= $threshold);
        $has_unread = $row['unread_count'] > 0 ? 'message' : '';

        // Hiányzó kép kezelése
        if (empty($row['img_user'])) {
            $row['img_user'] = 'forum_face_img.jpg';
        }

        $user_list[] = [
            'userhash'=>$row['User_Hash'],
            'unread' => $has_unread,
            'users_chats_id' => $row['users_chats_id'],
            'username' => $row['username'],
            'status' => $is_online ? 'Online' : 'Offline',
            'img_name' => $row['img_user']
        ];
    }
}

$stmt->close();

// Ha a szûrés után üres a lista, adjunk vissza üres JSON-t
if (empty($user_list)) {
    echo json_encode([]);
} else {
    echo json_encode($user_list);
}
?>
