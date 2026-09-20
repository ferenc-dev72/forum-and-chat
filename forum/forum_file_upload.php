<?php
session_start();

                 
  if (!isset($_SESSION['User_Hash'])){
      echo 'You have to login for upload!';
      exit();
  
  }
//---------------------------------------------
if ($_FILES['image']['name']) {
    if (!$_FILES['image']['error']) {
        // Ellenõrizzük a fájl méretét (5 MB = 5 * 1024 * 1024 bájt)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            echo json_encode(['error' => 'The file size is too large. It can be a maximum of 5 MB.']);
            exit;
        }

        // Ellenõrizzük a fájl típusát
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_types)) {
            echo json_encode(['error' => 'Only image files (jpg, jpeg, png, gif) are allowed to be uploaded.']);
            exit;   
        }

//------uvonalak (path)--------------------------------

 // server protocol
$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
 // domain name
$domain = $_SERVER['SERVER_NAME'];
 // domain name
$relativ_path = '/image/forum/upload_files/';

$urlAll = "${domain}{$relativ_path}";


//-----------------------------------------------------

   
        $name = md5(rand(100, 200));
        $filename = $name . '.' . $ext;
        $destination = 'upload_files/' . $filename; // változtasd meg ezt a könyvtárat
        $location = $_FILES["image"]["tmp_name"];
        move_uploaded_file($location, $destination);

        $forum_img_data[] = [
            'img_name' => $filename,   
            'url' => $urlAll.$filename,
            'protocol' => $protocol,
            'error' => '' // Nincs hiba
        ];
        echo json_encode($forum_img_data);
    } else {
        echo json_encode(['error' => 'Ooops! Your upload triggered the following error:: ' . $_FILES['image']['error']]);
    }
}






?>
