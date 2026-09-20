

<?php

//--------------------------
//----ADMIN COMMENT-------------------------------------------------------------
//--------------------------


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

// Kapcsolódás az adatbázishoz

include('db_connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
//----------------USER_LEVEL ellenorzese------------------------------------------------------
   
  if (isset($_SESSION['User_Hash'])) 
 {
  
         $hash = $_SESSION['User_Hash'];
        // Kapcsolat ellenorzese
        if ($conn->connect_error) {
            die("Kapcsolat hiba: " . $conn->connect_error);
        }

    $sql_lev = 'SELECT * FROM `users` where `User_Hash` = "'.$hash.'"';
 
       $result_lev = mysqli_query($conn,$sql_lev);
       $user_lev[]='';
       while ( $row_lev = $result_lev->fetch_assoc() ){
               $user_lev[] = $row_lev;
             }  
      
       $level_enable='';
    
       if ( ($user_lev['1']['User_Level'] == 1) || ($user_lev['1']['User_Level'] == 5)    ) {
             $level_enable='ok';
       }else{
           echo 'You do not have permission to edit';
           exit();
       }
        
 }
   

//--------------Commentek kiirasanak sorrenndje (latest, oldest stb....)--------------------------------------------------
// Sort order
// Rendezési sorrend
if (isset($_POST["ordered"]) && $_POST["ordered"] == 'oldest') {
    $ordered = 'ORDER BY d.`comment_id` ASC';
} elseif (isset($_POST["ordered"]) && $_POST["ordered"] == 'latest') {
    $ordered = 'ORDER BY d.`comment_id` DESC';
} elseif (isset($_POST["ordered"]) && $_POST["ordered"] == 'best') {
    $ordered = 'ORDER BY d.`comment_like` DESC';
} else {
    $ordered = 'ORDER BY d.`comment_id` DESC';
}

// Bõvített SQL lekérdezés, ami csatlakoztatja a `users_extras` táblát
// az `User_Hash` mezõ alapján, hogy hozzáadjuk az `img_user` mezõt a tömbhöz.
$sql = "SELECT d.*, ue.`img_user` FROM `discussions` d
        LEFT JOIN `users_extras` ue ON d.`User_Hash` = ue.`User_Hash`
        WHERE d.`img_id` = '$kepId' $ordered";

$hozzaszolasok = array();
if ($result = mysqli_query($conn, $sql)) {
    // Adatok kiolvasása az eredménybõl
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
 //----------COMMENTEK-RENDEZ?SE (lenyegi r?sz)------------------------------------------------------------------------------------


    // Hierarchikus rendezes
    $sorted_hozzaszolasok = array();
    foreach ($hozzaszolasok as $hozzaszolas) {
        $sorted_hozzaszolasok[$hozzaszolas['parent_id']][] = $hozzaszolas;
    }

 
     
    // Rekurziv fuggveny a hozzaszolasok megjelenitesere
    function displayComments($comments, $parentId = 0, $level = 0, $pxl = 0) {
        global $paragraph, $paragraph_double, $paragraph_half, $user, $comment_number;   
   
          
          if (!isset($user)) {$user['User_Name']='Guest'; $user['User_Hash']='guest001';}   // Ha nincs belepve -> username:Guest, userhash:Guest001 


            foreach ($comments[$parentId] as $comment) {
              $rnd = (rand(10,100000000));
            
              echo '<div style="width:800px; margin-left: 20px;margin-right: 20px; padding-top: 5px;">';
          
              // Itt módosítjuk a kép forrását (src) a 'forum_face_img.jpg'-rõl az $comment['img_user']-re
              echo '<table style="margin-left:'.$pxl.'px">';                   
              echo '<tr>';
              // Ellenõrizzük, hogy az img_user mezõ létezik és nem üres-e
              if (!empty($comment['img_user'])) {
                  echo '<td rowspan="2"><img src="./img_user/'.$comment['img_user'].'" alt="face" width="40" height="40" class="commentuser"></td>';
              } else {
                  // Ha nincs img_user érték, vagy üres, akkor egy alapértelmezett képet használunk
                  echo '<td rowspan="2"><img src="forum/forum_face_img.jpg" alt="face" width="40" height="40" class="commentuser"></td>';
              }
              echo '<td style="color:#0F1011;"><span class="forum_user">'.$comment['username'] . '</span></td>';         
              echo '</tr><tr><td title="'.$comment['comment_date_local'].'"><span style="color: rgb(108, 109, 110);font-size:12px; ;">'. calculated_date($comment['comment_date']).'</span></td>';    
              echo ' </tr></table>';
      
  //---------itt Kezdodik a COOMMENT -EDIT -DELETE -----------------------------------------------
      
                    
              echo'<table class="forum_commented" style="margin-left:'.($pxl+45).'px;"><tr style="color: gray;"><td>'.$comment['comment'] .'</td></tr></table>';
              echo'<table style="margin-left:'.($pxl+45).'px">';        
              echo '<tr style="text-align: right;">';
             
              echo '<td style="margin-left:'.($pxl+45).'px;"><button class="forum_admin_button" id="btnSn_'.$comment['comment_id'].'" style="color:black;background-color:gray;width:30px;height:22px;" onclick="toggleBtn('.$comment['comment_id'].')">sn</button></td>'; 
           
              echo '<td>&nbsp;&nbsp;&nbsp;</td>';
              echo '<td style="margin-left:'.($pxl+45).'px;"><button class="forum_delete_button" onclick="forum_delete_comment('.$comment['comment_id'].')">Delete</button></td>';  
             
              echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';

              echo '<td style="margin-left:'.($pxl+45).'px;"><button class="forum_admin_button" onclick="forum_edit_comment('.$comment['comment_id'].')">Edit</button></td>';

              echo'<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
            
           //   echo '<td><textarea id="edit_'.$comment['comment_id'].'" class="forum_commentInput" style="background-color:#212123;color: lightgray;" name="hozzaszolas" rows="3" cols="35" required>'.$comment['comment'] .'</textarea><br></td>';
             echo '<td><div id="add001" class="forum_adminInputPanel"><textarea id="edit_'.$comment['comment_id'].'" class="forum_commentInput summeradmin_edit'.$comment['comment_id'].'" style="background-color:#212123;color: lightgray;" name="hozzaszolas" rows="7" cols="50" required>'.$comment['comment'] .'</textarea></div><br></td>';
             //Nagyobb panel 
             
              echo '<input type="hidden" id="comment_id_admin" name="szHozzId" value="'.$comment['comment_id'].'">';
                     
              echo'</tr>';
                
             
              echo'</table>';  
              echo '<br>';
              
//itt volt regebben az "ADD Comment Panel" ------------------------------------------------------------------------- 


            if (isset($comments[$comment['comment_id']])) {
                displayComments($comments, $comment['comment_id'], $level + 1, $pxl + 47);
            }
           
            echo '</div>';
           
          
        }
   
  }
   
 
    // Minden hozzaszolas megjelenitese
       displayComments($sorted_hozzaszolasok);
 


$conn->close();



                                


?>

<script>





// summernote - beallitasok (image-hez) --------------------------
function summer_admin(comm_id) {
 
  
$(document).ready(function() {
  $('.summeradmin_edit'+comm_id).summernote({
    height: 120,
    width: 250,
    callbacks: {
      onInit: function() {
        $('.note-editable').css('background-color', 'black');
        $('.note-editable').css('color', 'white');
      }
    },
 
 
    toolbar: [
        ['style', ['bold', 'clear']],
       // ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
     //  ['table', ['table']],
      // ['insert', ['link', 'picture', 'video']],
        ['view', ['codeview']]
      ],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'],
         fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana']
  });

        $('.summeradmin_edit'+comm_id).each(function() {
        $(this).next(".note-editor.note-frame").css("border", "1px solid gray");
        $(this).next(".note-editor.note-frame").css({ width: "400",height: "130" });
        $(this).next(".note-editing-area").css({ width: "400",height: "130" });
       // $(this).next(".note-editable").css({ width: "500",height: "100" });
        $(this).next(".textarea.note-editing-area").css({ width: "400",height: "130" });
        $(this).next(".note-resizebar").css("display", "none");
        $(this).next(".note-editor.note-frame").css("border", "0px");
       
        $(this).next(".note-toolbar").css("background-color", "#25262b");
        $(this).next(".note-toolbar").css({bottom:-30, position:'absolute'});
        $(this).next(".note-toolbar").css("border-bottom", "0px"); 
        $(this).next(".note-toolbar").css("background-color", "black");
        $(this).next(".note-editable").css("background-color", "black");
         
      //  $(this).next(".note-toolbar").css("background-color", "#2d2e33");
        $('.note-resizebar').hide();
        $('.note-editor.note-frame.note-editing-area.note-editable').css('color','white');
      //  $('.note-editor.note-frame.note-editing-area.note-editable').css('background-color','black');
        $('.note-editable>p').css('color','white');
        /*
        $(".note-toolbar").css("background-color", "#25262b");
        $(".note-toolbar").css({bottom:-30, position:'absolute'});
         $(".note-toolbar").css("border-bottom", "0px"); 
          */
      });

        
          var styleEle = $("style#fixed");
          if (styleEle.length == 0)
          $("<style id=\"fixed\">.note-editor .dropdown-toggle::after { all: unset; } .note-editor .note-dropdown-menu { box-sizing: content-box; } .note-editor .note-modal-footer { box-sizing: content-box; }</style>")
          .prependTo("body");
          else
          styleEle.remove();
         
          $('.summeradmin_edit'+comm_id).summernote('foreColor' , 'white');  
       //   $('.summeradmin'+comm_id).summernote('background-color' , 'black');  

 }); 
} 

//---------end:summernote (image-hez)--------------------------------------------------------

//summernote -bekapcsolas (image-hez) -------------
let isSummerAdmin = true;

function toggleBtn(comm_id) {

  
//  var comm_id = document.getElementById(comment_id_admin);
  var btnsn = document.getElementById("btnSn_" + comm_id); 

  if (isSummerAdmin) {
    summer_admin(comm_id);
    btnsn.style.backgroundColor = "orange"; 
  } else {
    summernot_destroy(comm_id);
    btnsn.style.backgroundColor = "gray"; 
  }
  isSummerAdmin = !isSummerAdmin;
}


function summernot_destroy(comm_id) {
  $('.summeradmin_edit'+comm_id).summernote('destroy');
}



</script>