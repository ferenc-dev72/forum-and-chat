<?php

//----------- FORUM - Commentek kiirasa ----------------------------------------
//------------------------------------------------------------------------------




session_start();
    

//-----datum kiirasa (pl.2 days ago..)-----------------------------------------
 
 function calculated_date($date_comment)
{
   // az server / local idok kulonbsege --> most a server=UTC / local= +1 Hu   
   // ez az ertek (timeOffset) javascript oldalrol jott posttal
   if (isset($_POST["timeOffset"])) {$timeOffset=$_POST["timeOffset"];
   }else {$timeOffset="0";} 
 
    // date_comment + offcett
    $date_comment_offcetted = date('Y-m-d H:i:s', strtotime($date_comment.''.$timeOffset.' hour'));
   
   // date_now + offcett 
    $date_now_offcetted = date('Y-m-d H:i:s', strtotime(''.$timeOffset.'hour'));

    $date_comment_offcetted = date_create($date_comment_offcetted);
    $date_now_offcetted = date_create($date_now_offcetted); 

    $diff = date_diff($date_comment_offcetted, $date_now_offcetted);   //idok osszehasonlitasa
   //  $diff=date_diff($date1,$date2);
   //echo $diff->format("%R%a days");
  
      // var declare
    $msg_year = ""; 
    $msg_month = ""; 
    $msg_day = ""; 
    $msg_hour = ""; 
    $msg_min = "";  
    $msg_sec = ""; 
    $msg = "";

    foreach ($diff as $k => $v) {
        if ($k == 'y' && $v != 0) {
            $msg_year = $v;
        } 
        if ($k == 'm' && $v != 0) {
            $msg_month = $v;
        } 
        if ($k == 'd' && $v != 0) {
            $msg_day = $v;
        } 
        if ($k == 'h' && $v != 0) {
            $msg_hour = $v;
        } 
        if ($k == 'i' && $v != 0) {
            $msg_min = $v;
        } 
        if ($k == 's' && $v != 0) {
            $msg_sec = $v;
        } 
    }
    
    
    if ($msg_year > 0) {
        $msg = 'more than a year ago';
    } elseif ($msg_month > 0) {
        $msg = $msg_month.' months ago';
    } elseif ($msg_day > 0) {
        $msg = $msg_day.' days ago';
    } elseif ($msg_hour > 0) {
        $msg = $msg_hour.' hours ago';
    } elseif ($msg_min > 0) {
        $msg = $msg_min.' minutes ago';
    } elseif ($msg_sec > 0) {
        $msg = $msg_sec.' seconds ago';
    } else {
        $msg = 'just now';
    }
     
   return $msg;
}
 
    
 
  //ha nincs kepId -> kilep
   if (!isset($_POST["kepId"])){
        echo "The image don't be loaded";
        echo '<br>';
        echo '<a href="javascript:history.go(-1)">Back</a>';
        die();
} else {$kepId = $_POST["kepId"];}


// var decleare
$paragraph_half = '&nbsp;&nbsp;&nbsp;';
$paragraph = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$paragraph_double = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

//svg
$svg_report='valamii';




// Kapcsolódás az adatbázishoz

include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//---------------------------------------------------------------------------------








//--------------Commentek kiirasanak sorrenndje (latest..)----------------------
// Sort order
// Rendezési sorrend
$ordered='';

if (isset($_POST["ordered"]) && $_POST["ordered"] == 'oldest') {
    $ordered = 'ORDER BY d.`comment_id` ASC';
} elseif (isset($_POST["ordered"]) && $_POST["ordered"] == 'latest') {
    $ordered = 'ORDER BY d.`comment_id` DESC';
} elseif (isset($_POST["ordered"]) && $_POST["ordered"] == 'best') {
    $ordered = 'ORDER BY d.`comment_like` DESC';
} else {
    $ordered = 'ORDER BY d.`comment_id` ASC';
}


// Bővített SQL lekérdezés, ami csatlakoztatja a `users_extras` táblát
// az `User_Hash` mező alapján, hogy hozzáadjuk az `img_user` mezőt a tömbhöz.
$sql = "SELECT d.*, ue.`img_user` FROM `discussions` d
        LEFT JOIN `users_extras` ue ON d.`User_Hash` = ue.`User_Hash`
        WHERE d.`img_id` = '$kepId' $ordered";

$hozzaszolasok = array();
if ($result = mysqli_query($conn, $sql)) {
    // Adatok kiolvasása az eredményből
    while ($row = $result->fetch_assoc()) {
        $hozzaszolasok[] = $row;
    }

    // Hozzászólások megjelenítése
 /*   foreach ($hozzaszolasok as $hozzaszolas) {
        print_r($hozzaszolas);
    }*/
}

// HA NINCS HOZZÁSZÓLÁS --> KILÉP! (nem fog kiírni kommentet)
if (empty($hozzaszolasok)) {
    echo "<br />";   
 //   echo $paragraph_half."<p>There are no comments yet</p>";
    exit();
}

    
    if (isset($_SESSION['User_Hash'])){   // csak ha be van lepve, akkor fut le   
        
       //-------user adatok lekerese /hash alapjan - users table/-------------------------------------------------------    
        
        $sql2 = 'SELECT * FROM `users` where `User_Hash` = "'.$_SESSION['User_Hash'].'"';
        
        if ($result2 = mysqli_query($conn, $sql2)) {
            while ($row2 = $result2->fetch_assoc()) {
                $user = $row2;
            } }
       }    

 //-----------------------------------------------------------------------------
 //----------COMMENTEK-RENDEZ�SE (lenyegi r�sz)------------------------------------------------------------------------------------


    // Hierarchikus rendezes
    $sorted_hozzaszolasok = array();
    foreach ($hozzaszolasok as $hozzaszolas) {
        $sorted_hozzaszolasok[$hozzaszolas['parent_id']][] = $hozzaszolas;
    }

 
     
    // Rekurziv fuggveny a hozzaszolasok megjelenitesere
    function displayComments($comments, $parentId = 0, $level = 0, $pxl = 0) {
        global $paragraph, $paragraph_double, $paragraph_half, $user, $comment_number;   
   
          
          if (!isset($user)) {$user['User_Name']='Guest'; $user['User_Hash']='guest001';}   // Ha nincs belepve -> username:Guest, userhash:Guest001 
         
      
         
         /* foreach ($comments[$parentId] as $comment) {
            $rnd = (rand(10,100000000));
          
            echo '<div style="width:800px; margin-left: 20px;margin-right: 20px; padding-top: 5px;">';
                     
              echo'<table style="margin-left:'.$pxl.'px">';                   
              echo'<tr>';
              echo '<td rowspan="2"><img src="forum/forum_face_img.jpg" alt="face" width="40" height="40"></td><td style="color:#0F1011;">
              <span class="forum_user">'.$comment['username'] . '</span></td>';         
              echo'</tr><tr><td title="'.$comment['comment_date_local'].'"><span style="color: rgb(108, 109, 110);font-size:12px; ;">'. calculated_date($comment['comment_date']).'
              </span></td>';    
              echo' </tr></table>';
              
 */

              foreach ($comments[$parentId] as $comment) {
                $rnd = (rand(10,100000000));
              
                echo '<div class="comment_container" style="word-wrap:break-word; width:auto; margin-left: 10px;margin-right:0px; padding-top:5px;">';
                 
                // Itt módosítjuk a kép forrását (src) a 'forum_face_img.jpg'-ről az $comment['img_user']-re
                echo '<table style="margin-left:'.$pxl.'px">';                   
                echo '<tr>';
                echo '<input type="hidden" id="comm_uhas'.$comment['comment_id'].'" value="'.$comment['User_Hash'].'">';
                
                // Ellenőrizzük, hogy az img_user mező létezik és nem üres-e
                if (!empty($comment['img_user'])) {    
                    echo '<td rowspan="2"><img src="./img_user/'.$comment['img_user'].'" style="cursor:pointer;" alt="face" onclick="user_profil('.$comment['comment_id'].')" width="40" height="40" class="commentuser"></td>';
                } else {
                    // Ha nincs img_user érték, vagy üres, akkor egy alapértelmezett képet használunk
                    echo '<td rowspan="2"><img src="forum/forum_face_img.jpg" style="cursor:pointer;" alt="face" onclick="user_profil('.$comment['comment_id'].')" width="40" height="40" class="commentuser"></td>';
                }
                echo '<td style="color:#0F1011;"><span class="forum_user">'.$comment['username'] . '</span></td>';         
                echo '</tr><tr><td title="'.$comment['comment_date_local'].'"><span style="color: rgb(108, 109, 110);font-size:12px; ;">'. calculated_date($comment['comment_date']).'</span></td>';    
                echo ' </tr></table>';
                                                   
               echo'<table class="forum_commented" style="margin-left:'.($pxl+45).'px;">';
                echo '<tr>';
             //   echo '<td style="word-wrap: break-word; overflow-wrap: break-word; max-width: 100%; width: auto;">'.$comment['comment'] .'</td>';
             echo '<td style="word-wrap: break-word; overflow-wrap: anywhere; max-width: 100%; width: auto; white-space: pre-wrap; overflow-x: auto;">'.($comment['comment']).'</td>';
           


                echo '</tr>';
                echo '</table>';


                 
                echo'<table style="margin-left:'.($pxl+45).'px;" class="pluselements">';        
                echo'<tr>';
              
              if ($comment['like_to_userid'] != ''  ){ 
                 echo '<td align="center" style="width:33px;" class="forum_tooltip--left" data-tooltip="'.htmlspecialchars($comment['like_to_uname'], ENT_QUOTES, 'UTF-8').'" onclick="forum_submit_like('.$comment['comment_id'].','.$rnd.')">';
                 echo '<img src="/image/forum/forumLike.png" alt="like" width="17" height="17">';
                 echo '</td>';
                 echo '<td style="color:rgb(108, 109, 110);">'.$comment['comment_like'] .'</td>';
              }   
               else{echo '<td align="center" style="width:33px;" class="forum_like" onclick="forum_submit_like('.$comment['comment_id'].','.$rnd.')"><img src="/image/forum/forumLike.png" alt="like" width="17" height="17"><td style="color:rgb(108, 109, 110);">'.$comment['comment_like'] .'</td></td>';}

              echo '<td>&nbsp;&nbsp;&nbsp;</td>';
             
             /*
              if ($comment['dislike_to_userid'] != ''  ){ 
                 echo '<td align="center" style="width:33px;" class="forum_tooltip--left" data-tooltip="'.htmlspecialchars($comment['dislike_to_uname'], ENT_QUOTES, 'UTF-8').'" onclick="forum_submit_dislike('.$comment['comment_id'].','.$rnd.')">';
                 echo '<img src="/image/forum/forumDislike.png" alt="dislike" width="17" height="17">';
                 echo '</td>';
                 echo '<td style="color:rgb(108, 109, 110);">&nbsp;'.$comment['comment_dislike'] .'</td>';
               }
                else{ echo '<td align="center" style="width:33px;" class="forum_dislike" onclick="forum_submit_dislike('.$comment['comment_id'].','.$rnd.')"><img src="/image/forum/forumDislike.png" alt="dislike" width="17" height="17"><td style="color:rgb(108, 109, 110);">&nbsp;'.$comment['comment_dislike'] .'</td></td>';}
              */          
              
 //report-PNG-svg---------------------------------------------------------------
               
                  echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>'; 
                  echo '<td style="width:5px;">';
                  echo '<span class="report_forum">';
                  echo '<img src="/image/forum/forum_svg_report.png" onclick="forum_report_comment('.$comment['comment_id'].')" id="forum_png_report_'.$comment['comment_id'].'" alt="dislike" width="17" height="17">';
                  echo '</span>';
            
                //report -FORM
                  if (isset($_SESSION['User_Hash'])){     
                  echo '<form action="index.php?modul=report_form_comment" method="POST" id="forum_report_user_'.$comment['comment_id'].'" target="_blank">';
                  echo '<input type="hidden" name="reported_image" value="value1">';
                  echo '<input type="hidden" name="reported_model_name" value="value2">';
                  if (!empty($comment['img_user'])) {
                      echo '<input type="hidden" name="reported_u_image" value="./img_user/'.$comment['img_user'].'">';
                  }else{
                      echo '<input type="hidden" name="reported_u_image" value="./img_user/forum_face_img.jpg">';
                  }
                  echo '<input type="hidden" name="reported_u_name" value="'.$comment['username'].'">';
                  echo '<input type="hidden" name="reporter_hash" value="'.$_SESSION['User_Hash'].'">';
                  echo '<input type="hidden" name="reported_hash" value="'.$comment['User_Hash'].'">';
                  echo '<input type="hidden" name="reported_comment_id" value="'.$comment['comment_id'].'">';
                  echo '<input type="hidden" name="comment_img_id" value="'.$comment['img_id'].'">';
                   echo '<input type="hidden" name="comment_type" value="comment_img">';
                  
                  echo '<button type="submit" class="hidden">Küldés</button>';
                  echo '</form>';
             
            
                  echo '</td>';
                 }  
   //end_report ----------------------------------------------------------------       
              echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>'; 
               echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
        
               echo '<td style="margin-left:'.($pxl+45).'px;"><button class="forum_button" style="color:rgb(108, 109, 110);" onclick="forum_add_comment('.$comment['comment_id'].','.$rnd.','. $level.')">Comment</button></td>';
              
     //edit-gomb (ceruza)-------------------------------------------------------
               if ($comment['User_Hash'] == $user['User_Hash'] ){   
                   echo '<td style="margin-left:'.($pxl+45).'px;"><button class="forum_button" style="color:rgb(108, 109, 110);" onclick="forum_add_edit('.$comment['comment_id'].','.$rnd.')">&#x1f589;</button></td>';
               }                          
           //-------------------------------------------------------------------
                    
              echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';   
           
              echo'</tr>'; 
              echo'</table>';  
           //end:tablazat (sorveg)------------------------------------------------------------------------------------------- 
              echo '<br>';
              
      //-------add_editPanel--------------------------       
               echo '<div id="addEditPanel_'.$comment['comment_id'].'" class="forum_addPanel_hide" style="display:none; height:170px; margin-left:'.($pxl+45).'px">';
                
               //summernote-plugin: forum.js -> summer_general(hozzid)  
               echo '<textarea id="add_edit_'.$comment['comment_id'].'" class="forum_commentInput summer'.$comment['comment_id'].'" name="hozzaszolas" rows="7" cols="50" required>'.$comment['comment'].'</textarea><br>';
               echo '<br><br>';
               echo '<button class="forum_commentButton" style="margin:2px;" onclick="forum_addEdit_submit('.$comment['comment_id'].')">EDIT SUBMIT</button>';
               echo '<button class="forum_commentButton" style="margin:2px;" onclick="forum_addEdit_delete('.$comment['comment_id'].')">DELETE</button>';
               echo '<input type="hidden" id="userHashCommented_'.$comment['comment_id'].'" name="user_hash" value="'.$comment['User_Hash'].'">'; 
               echo '</div>';                 
//---------------Add comment panel--------------------------------------------------------------------------------------------
                
                echo '<div id=add01_'.$comment['comment_id'].'_'.$rnd.' class="forum_addPanel_hide" style="display:none;margin-left:'.($pxl+45).'px">';
              
                echo '<table><tr>';

                echo '<td><img src="/image/forum/forum_face_img.jpg" name="base_avatar_face" id="add_comment_face02_'.$comment['comment_id'].'" alt="face" width="33" height="33" class="commentface"></td>';
                echo '<td><input type="text" id="szerzo_'.$rnd.'" name="szerzo" class="forum_commentWriter" value="'.$user['User_Name'].'" readonly></td>';
                echo'</tr></table>';   

                    //summernote-plugin: forum.js -> summer_general(hozzid)  
                    echo '<textarea id="hozzaszolas_'.$rnd.'" class="forum_commentInput summer'.$comment['comment_id'].'" name="hozzaszolas" rows="7" cols="50" required></textarea><br>';

                    echo '<input type="hidden" id="kepid_'.$rnd.'" name="kepid" value="'.$comment['img_id'].'">';
                    echo '<input type="hidden" id="szuloHozzaszolasId_'.$rnd.'" name="szHozzId" value="'.$comment['comment_id'].'">'; 
                    echo '<input type="hidden" id="userHash_'.$rnd.'" name="user_hash" value="'.$user['User_Hash'].'">'; 
                    echo '<input type="hidden" id="comment_img_upload" name="szHozzId" value="'.$comment['comment_id'].'">';
                    echo '<input type="hidden" id="comment_img_upload_rnd" name="rnd" value="'.$rnd.'">';
                    echo '<br><br>';
                    echo '<button class="forum_commentButton" onclick="forum_submit_comment('.$comment['comment_id'].','.$rnd.')">COMMENT SUBMIT</button>';
         
               
                echo '</div>';
            
                echo '<br>';                                                                                           
  
                echo '<div id=msgPanel01_'.$comment['comment_id'].'_'.$rnd.' class="forum_msgPpanel_hide" style="margin-bottom:5px; margin-left:'.($pxl+47).'px;">';
                echo '</div>';
             
//-------------------------------------------------------------------------------------------------------------------------

            if (isset($comments[$comment['comment_id']])) {
                $eltolas=25; if ($level>3) {$eltolas=0;}
                displayComments($comments, $comment['comment_id'], $level + 1, $pxl + $eltolas);   //ket egymas alatt levo komment tavolsaga (oldalra viszonyitva:most 25px)
            }
           
            echo '</div>';
           
          
        }
    }
  
 //echo'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />';  
  
    // Minden hozzaszolas megjelenitese
       displayComments($sorted_hozzaszolasok);
         


$conn->close();



                                
 //https://www.apedh-assoc.org/plugins/summernote/summernote-lite.min.css
  //https://www.apedh-assoc.org/plugins/summernote/summernote-lite.min.js

?>

