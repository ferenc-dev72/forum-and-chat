<?php
session_start(); 

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./chat-categories_main.css" rel="stylesheet" /> 
    <title>Chat Rendszer</title>
   
</head>
<body>
       
<div id="chatContainer">
    <div id="leftPanel">
        <div class="button-container">
            <button id="showActiveUser" class="toggle-ulist">Active</button>
            <button id="showPendingUser" class="toggle-ulist">Pending</button>
            <button id="showArchivedUser" class="toggle-ulist">Archived</button>
        </div>

        <!--  UsersLists -->
        <ul id="userList"></ul>
        <ul id="userList_active"></ul>
        <ul id="userList_archived"></ul>
        <input type="hidden" id="chat_state" name="chat_state" value="" />
        <input type="hidden" id="chatuser_id" name="chatuser_id" value="" />
        <input type="hidden" id="chatpartner_id" name="chatpartner_id" value="" />
        <input type="hidden" id="pending_list" name="chatpartner_id" value="" />
    </div>

    <div id="rightPanel">
        <div class="chat-header" id="chatHeader_main">
            <span class="chatname" id="chatUser_main"></span>
            <span class="chat-Time" id="chatTime_main"></span>
            <table>
                <tr> 
                    <td><span class="chat-options" id="chatOptions"></span></td>
                    <td><span onclick="closeUserSelectWin_main()" id="closeUserSelect"><img src='/image/chat/icons/close_red.png' alt='close' width='25' height='25'></span></td>
                </tr>
            </table>
        </div>

        <div class="chat-messages" id="chatMessages_main">
        </div>

        <div class="input-container">
    <input type="text" id="chatInput_main" onclick="archived_input_disabled()" class="chat-input" placeholder="Write a message...">
    <div class="icon-container">
       <!--  <button id="addLink">&#128279;</button> Link ikon -->
        <button id="addEmoji">&#128512;</button> <!-- Mosolygos ikon -->
        &nbsp;&nbsp;&nbsp;
        <button id="sendMessage"><img src='/image/chat/icons/submit.png' alt='join' width='30' height='30'></button> <!-- Kuldes gomb -->
    </div>
</div>


        <div class="emoji-picker" id="emojiPicker">
          <table> 
           <tr><td><span>&#128512</span></td><td><span>&#128543</span></td><td><span>&#128077</span></td><td><span>&#128514</span></td></tr> 
           <tr><td><span>&#128513</span></td><td><span>&#128516</span></td><td><span>&#128517</span></td><td><span>&#128518</span></td></tr> 
           <tr><td><span>&#128533</span></td><td><span>&#128534</span></td><td><span>&#128539</span></td><td><span>&#128540</span></td></tr> 
           <tr><td><span>&#128543</span></td><td><span>&#128544</span></td><td><span>&#128545</span></td><td><span>&#128553</span></td></tr> 
           <tr><td><span>&#129296</span></td><td><span>&#129297</span></td><td><span>&#129299</span></td><td><span>&#129312</span></td></tr> 
           <tr><td><span>&#129398</span></td><td><span>&#128127</span></td><td><span>&#128128</span></td><td><span>&#129324</span></td></tr> 
           <tr><td><span>&#128077</span></td><td><span>&#128078</span></td><td><span>&#9996</span></td><td><span>&#129311</span></td></tr>
           <tr><td><span>&#128187</span></td><td><span>&#128188</span></td><td><span>&#128198</span></td><td><span>&#128191</span></td></tr> 
           <tr><td><span>&#128222</span></td><td><span>&#128506</span></td><td><span>&#128640</span></td><td><span>&#128661</span></td></tr> 
           <tr><td><span>&#128664</span></td><td><span>&#128674</span></td><td><span>&#128054</span></td><td><span>&#128049</span></td></tr> 
           <tr><td><span>&#9749</span></td><td><span>&#127866</span></td><td><span>&#127865</span></td><td><span>&#127804</span></td></tr> 
           <tr><td><span>&#127828</span></td><td><span>&#127829</span></td><td><span>&#127846</span></td><td><span>&#127796</span></td></tr> 
           <tr><td><span>&#9917</span></td><td><span>&#127937</span></td><td><span>&#127758</span></td><td><span>&#9925</span></td></tr> 
           <tr><td><span>&#128085</span></td><td><span>&#128086</span></td><td><span>&#127911</span></td><td><span>&#127928</span></td></tr> 
           <td><span>&#127874</span></td><td><span>&#127875</span></td><td><span>&#127877</span></td><td><span>&#127876</span></td></tr> 
        </table>   
        </div>
    </div>
</div>




</body>
</html>



<script>
/*chat---------------------------------------------------------------------------------------------------*/

  //  var open_chat = document.getElementById('openChat');

  
//interval valtozok declaralasa (idokozonkenti xml-keres)  
if (typeof interval_lastactive_main === 'undefined') {
    var interval_lastactive_main;
}

if (typeof interval_userlist === 'undefined') {
    var interval_userlist;
}

if (typeof intervalId_main === 'undefined') {
    var intervalId_main;
}


    var closeUserSelect = document.getElementById('closeUserSelect');
    var chatBox = document.getElementById('chatBox');
    var chatInput_main = document.getElementById('chatInput_main');
   


 $(document).ready(function(){

 $('#addEmoji').click(function() {
        $('#emojiPicker').toggle();
    });

    // Add selected emoji to input
    $('#emojiPicker span').click(function() {
        var emoji = $(this).text();
        $('#chatInput_main').val($('#chatInput_main').val() + emoji);
        $('#emojiPicker').hide();
    });

    // Toggle link input
   /*
    $('#addLink').click(function() {
        var link = prompt('Enter the link URL:');
        if (link) {
            var text = prompt('Enter the link text:');
            if (text) {
                var currentText = $('#chatInput_main').val();
                var newText = `<a class="chat-link" href="${link}" target="_blank">${text}</a>`;
                $('#chatInput_main').val(currentText + newText);
            }
        }
    });
     */
    
    

    if ( (typeof lastMessageId === 'undefined') || (lastMessageId == null) ) {
      lastMessageId=0;
    }
 
    if ( (typeof targetUserId === 'undefined') || (targetUserId == null) ) {
      targetUserId=null;
    }

    if ( (typeof open_chat === 'undefined') || (open_chat == null) ) {
      open_chat='';
    }

    if ( (typeof closeUserSelect === 'undefined') || (closeUserSelect == null) ) {
      closeUserSelect='';
    }

    if ( (typeof chatBox === 'undefined') || (chatBox == null) ) {
      chatBox='';
    }
    if ( (typeof chatInput_main === 'undefined') || (chatInput_main == null) ) {
        chatInput_main='';
    }
    if ( (typeof chatContainer === 'undefined') || (chatContainer == null) ) {
        chatContainer='';
    }
    
    if ( (typeof targetUserId != 'undefined') || (targetUserId != null) ) {
      targetUserId=null;
    }


//FONTOS!
//interval valtozok tisztitasa a tobbi chat ablak megnyitas miatt

allCleanInterval_main();
//-----------------------------------------------


   


//chat id lekeres:  uid = chat_user_id
$.ajax({     
  url: '/image/chat/chat_user_id.php', 
  success: function(data) {
    uid = data;  
    uid = uid.trim().replace(/[^\x20-\x7E]/g, ''); 
    
//---------Pending toltodik be eloszor
  /*
    loadUserList_pending(); //lista beolvas
    $('#showPendingUser').addClass('active');
   
  
    $('#userList_archived').hide();
    $('#userList_active').hide();
*/
//-----
//---------Active toltodik be eloszor
  
     loadUserList_active(); //lista beolvas
    $('#showActiveUser').addClass('active');
    
    $('#userList_archived').hide();
    $('#userList_active').show();
    $('#userList').hide();

    loadUserList_pending();
   /* if ( document.getElementById('pending_list').value != '' ) {
        $('#showPendingUser').addClass('pending');
    } */
    

//-----

      // Event handler for the "Pending" button
      $('#showPendingUser').on('click', function() {    
         $('#userList_active').hide();
         $('#userList_archived').hide();
         $('#userList').show();
         loadUserList_pending(); // Load message (pending) users
        

    });

    // Event handler for the "Search Archive" button
    $('#showActiveUser').on('click', function() {
      //  $('#searchInput').show(); // Show the search input field
        $('#userList').empty(); // Clear the list when searching
        $('#userList_archived').hide();
        $('#userList_active').show();
        $('#userList').hide();
        loadUserList_active();
    });


      // Event handler for the "Arcived" button
      $('#showArchivedUser').on('click', function() {    
         $('#userList_archived').show();
         $('#userList_active').hide();
         $('#userList').hide();
         loadUserList_archived();
        

    });
  
  
  //  $('#chatBox').css('display', 'none');
  //  clearInterval(intervalId_main);
  //  clearInterval(interval_lastactive_main);

  }

  

});

       

  

// Az esemenykezelot jQuery-vel hozzuk letre
$('#closeChat').on('click', function() {
  closeChatWindow_main();
 
  });

  cMessagesBox = document.getElementById('chatMessages_main');
  if (cMessagesBox){
     closeChatWinState();
      //alert('ok');
   }



});


 //FONTOS!
  //interval valtozok tisztitasa a tobbi chat ablak megnyitas miatt
  function allCleanInterval_main() {
  
  if (typeof interval_lastactive_main != 'undefined') {
    clearInterval(interval_lastactive_main);
  }
  if (typeof intervalId_main != 'undefined') {
      clearInterval(intervalId_main);
  }  

  //image-chat-miatt
  if (typeof interval_lastactive_image != 'undefined') {
      clearInterval(interval_lastactive_image);
  }
  if (typeof intervalId_image != 'undefined') {
      clearInterval(intervalId_image);
  } 

  //model-chat-miatt
  if (typeof interval_lastactive_model != 'undefined') {
      clearInterval(interval_lastactive_model);
  }
  if (typeof intervalId_model != 'undefined') {
      clearInterval(intervalId_model);
  } 

}



function closeUserSelectWin_main() {
     targetUserId = null; 
    
    var chatContant = document.getElementById('chatContainer');
    if (chatContant){chatContant.style.display = 'none';}
   
    var message_main = document.getElementById('chatMessages_main');
    if (message_main){message_main.InnerHtml = '';}
    closeChatWindow_main();
    if (typeof interval_lastactive_main != 'undefined') {
       clearInterval(interval_lastactive_main);
     }

    if (typeof intervalId_main != 'undefined') {
       clearInterval(intervalId_main);
    }  
}



/*
function openUserSelectWin() {
    document.getElementById('userSelectWindow').style.display = 'block';
    interval_userlist = setInterval(loadUserList_pending, 15000);
}
*/




function update_usersList(){

  $.ajax({
    url: "/image/chat/users_list_update.php", 
    type: "POST",
    success: function(response) {
      // Sikeres frissites eseten teendoek (pl. uzenet megjelenitese)
      //console.log("Success: Update users-list!");
    },
    error: function(xhr, status, error) {
      // Hiba eseten teendoek (pl. hibauzenet megjelentese)
      console.error("Error update - users list: " + error);
    }
  });

}


function setTargetUserId(userId) {
    targetUserId = userId;
    allCleanInterval_main();
   if (targetUserId){
 
        openChatWindow_main();
        chatMessages_main.innerHTML='';   //kiuritjuk az uzeneteket, hogy user-valtasnal a scroll ertek jo legyen.
        lastMessageId = 0;
        loadMessages_main(); // Betolti az uzeneteket
        updateChatHeader_main(); // Frissiti a chat fejlecet
   }

}

function loadUserList_pending() {
    $.ajax({
    url: '/image/chat/user_list_data.php',
    method: 'GET',
    dataType: 'json',
    data: { uid: uid, filter: 'unread' }, // Hozzaadjuk az uid parametert
    success: function(users) {
        var userList = $('#userList'); 
        userList.empty();
        if (users.length === 0) {  
            $("#showPendingUser").removeClass("pending");
            userList.append('<li style="color:black;text-align: center;">NO CHAT &#8709;</li>');
        } else { 
            $('#showPendingUser').addClass('pending');
            users.forEach(function(user) {
                var statusIcon = user.status === 'Online' ? '<span class="status-icon online"></span>' : '<span class="status-icon offline"></span>';
                var newMessageIcon = user.unread === 'message' ? '<img src="/image/chat/icons/message.png" alt="new message" width="25" height="10" class="new-message-icon">' : '';
                var li = $('<li class="ulist_li">').html(
                    '<img src="/image/img_user/' + user.img_name + '" alt="face" width="40" height="40" class="commentuser">' +
                    statusIcon + '&nbsp;&nbsp;&nbsp;' + user.username + ' ' + newMessageIcon
                );

                // Popup esemény kezelése
                li.on('click', function(event) {
                    event.stopPropagation(); // Megakadályozza a lista eltűnését
                    showUserOptionsMenu(event, user.users_chats_id);
                });

                // Kép kattintás esemény kezelése
                li.find('.commentuser').on('click', function(event) {
                    event.stopPropagation(); // Megakadályozza a li eseménykezelőjének lefutását
                    showUserInfo(user.userhash); // Felhasználói infók megjelenítése
                });

                userList.append(li);
            });
        }
    },
    error: function(xhr, status, error) {
        console.error('Failed to load user list:', error);
    }
});

function showUserInfo(userhash) {
    window.open('index.php?modul=creator_page&userhash=' + userhash, '_blank'); ;
  
}

}

// Popup menü megjelenítése
function showUserOptionsMenu(event, users_chats_id) {
    var menu = $('<div class="user-options-popup">')
        .html(`
            <div class="popup-option" style="color:#389b38;" onclick="addToActiveList(${users_chats_id})"><table class="popup-option" style="color:#389b38;"><tr><td>Accept</td><td><img src='/image/chat/icons/join_chat.png' alt='join' width='20' height='20'></td></tr></table></div>
            <div class="popup-option" style="color:#ef4343;" onclick="removeFromPendingList(${users_chats_id})"><table class="popup-option" style="color:#ef4343;"><tr><td>Reject</td><td><img src='/image/chat/icons/delete_chat.png' alt='delete_chat' width='12' height='12'></td></tr></table></div>
        `)
        .css({
            position: 'absolute',
            top: event.pageY + 'px',
            left: event.pageX + 'px',
            background: '#333',
            color: '#fff',
            padding: '10px',
            borderRadius: '6px',
            zIndex: 999001
        });

    // Ellenőrizd, hogy már van-e popup és távolítsd el
    $('.user-options-popup').remove();
    $('body').append(menu);

    // Kattintás esetén a menü eltüntetése
    $(document).on('click.popup', function() {
        menu.remove();
        $(document).off('click.popup');
    });
}

// Felvétel a listába
function addToActiveList(users_chats_id) {
    $.ajax({
        url: '/image/chat/insert_active_chats.php',
        method: 'POST',
        data: { uid: uid, users_chats_id: users_chats_id },
        success: function() {
            alert('Added to active list');
            $('#chatInput_main').val('[SYSTEM]:JOINED');
          //  sendMessage(users_chats_id);
            sendMessage(users_chats_id,1);
            loadUserList_active();
            loadUserList_pending();
        },
        error: function(xhr) {
            console.error('Failed to add user:', xhr.responseText);
        }
    });
        


}

// Törlés a listából
function removeFromPendingList(users_chats_id) {
 //  alert(users_chats_id);
 //  alert(uid);
 const confirmation = confirm("Are you sure you want to delete this chat?");
    if (!confirmation) {
        return; // Ha a felhasznalo nem erositi meg, kilepunk.
    }
  
    markMessagesAsRead(uid,users_chats_id);
    $('#chatInput_main').val('[SYSTEM]:LEFT');
    // sendMessage(users_chats_id);
    sendMessage(users_chats_id,1);
    loadUserList_active();
    loadUserList_pending();
    // document.getElementById("chatMessages_main").innerHTML='';

}






function loadUserList_active() {

$.ajax({
url: '/image/chat/user_list_active.php',
method: 'GET',
dataType: 'json',
data: { uid: uid }, // Hozzaadjuk az uid parametert
success: function(users) {
 // console.log(users);   
  var userList = $('#userList_active');
  userList.empty();
 
  if (users.length === 0) {
                userList.append('<li style="color:black;text-align: center;">NO CHAT &#8709;</li>');  
            } else {
                users.forEach(function(user) {
                    var statusIcon = user.status === 'Online' ? '<span class="status-icon online"></span>' : '<span class="status-icon offline"></span>';
                    var newMessageIcon = user.unread === 'message' ? '<img src="/image/chat/icons/message.png" alt="new message" width="25" height="10" class="new-message-icon">' : '';
                    var li = $('<li class="ulist_li">').html('<img src="/image/img_user/'+ user.img_name +'" alt="face" width="40" height="40" class="commentuser">' + statusIcon + '&nbsp;&nbsp;&nbsp;' + user.username + ' ' + newMessageIcon);
                    
                    li.on('click', function() {
                        setTargetUserId(user.users_chats_id);
                    });
                    userList.append(li);
                });
           }

},
error: function(xhr, status, error) {
    console.error('Failed to load user list:', error);
}
});
}


function loadUserList_archived() {

$.ajax({
url: '/image/chat/user_list_archived.php',
method: 'GET',
dataType: 'json',
data: { uid: uid }, // Hozzaadjuk az uid parametert
success: function(users) {
 // console.log(users);   
  var userList = $('#userList_archived');
  userList.empty();

  if (users.length === 0) {
                userList.append('<li style="color:black;text-align: center;">NO CHAT &#8709;</li>');  
            } else {
                users.forEach(function(user) {
                    var statusIcon = user.status === 'Online' ? '<span class="status-icon online"></span>' : '<span class="status-icon offline"></span>';
                    var newMessageIcon = user.unread === 'message' ? '<img src="/image/chat/icons/message.png" alt="new message" width="25" height="10" class="new-message-icon">' : '';
                    var li = $('<li class="ulist_li">').html('<img src="/image/img_user/'+ user.img_name +'" alt="face" width="40" height="40" class="commentuser">' + statusIcon + '&nbsp;&nbsp;&nbsp;' + user.username + ' ' + newMessageIcon);
                    
                    li.on('click', function() {
                        setTargetUserId(user.users_chats_id);
                    });
                    userList.append(li);
                });
            }    
},
error: function(xhr, status, error) {
    console.error('Failed to load user list:', error);
}
});
}



$(document).ready(function(){

// Esemenyek a gombokhoz: figyeljuk az active class valtozast
$('.toggle-ulist').on('click', function() {
    $('.toggle-ulist').removeClass('active'); // Minden gomb inaktív lesz
    $(this).addClass('active'); // Csak a kattintott gomb lesz aktív
   
});

});




function openChatWindow_main() {
//$('#chatBox').show(); // Beallitja a chatBox-ot lathatova
interval_lastactive_main = setInterval(updateLastActive_main, 30000);

$.ajax({
url: '/image/chat/update_chat_status.php',
method: 'POST',
data: {
    users_chats_id: uid,
    status: 'open'
},
success: function(response) {
     // markMessagesAsRead(); // Uzenetek olvasotta tetele
},
error: function(xhr) {
    console.error('Failed to update chat status:', xhr.responseText);
}
});


  //Ha nincs kivalasztva user, ne olvassa be az uzeneteket!
  var chatUser_div = $('#chatUser_main');
  if (chatUser_div.length === 0) {
      updateChatHeader_main(); 
   }else{ 
      intervalId_main = setInterval(loadMessages_main, 3000); // Refresh messages every 3 seconds
  }

//intervalId_main = setInterval(loadMessages_main, 3000); // Refresh messages every 3 seconds

}



function markMessagesAsRead(self, target) {
   // alert(target);
    if (self) {users_chats_id = self;}
    if (target) {targetUserId = target;}
    // targetUserId
    if ($('#chatMessages_main').css('display') === 'block') {
    $.ajax({
    type: 'POST',
    url: '/image/chat/mark_messages_read.php',
    data: { users_chats_id: uid, targetUserId: targetUserId },
    success: function(response) {
        //console.log('Messages marked as read.');
        loadUserList_active();
        loadUserList_archived();
        loadUserList_pending();
    },
    error: function(xhr, status, error) {
        // Opcio: kezelheted az esetleges hibakat itt
        console.error('Failed to mark messages as read:', error);
    }
});
}
}

 $(document).ready(function(){
 
    //uzenet olvasotta tetele (read)
    if (chatContainer != '') { 
     
        $('#userList').on('click', function() {
         // markMessagesAsRead();  
        });
 
        /*
        $('#userList_archived').on('click', function() {
          markMessagesAsRead();  
        });
        */

        $('#userList_active').on('click', function() {
          markMessagesAsRead();  
          
        });
   
       
        $('#chatInput_main').click(function() {
           if (targetUserId){
             markMessagesAsRead(uid,targetUserId); 
            }
        
        });
   
   
        // Esemeny, amikor az input mezo fokuszban van
        $('#chatInput_main').on('focus', function() {
            if (targetUserId){
             markMessagesAsRead(uid,targetUserId); 
            }
            

        });

        // Esemeny, amikor az input mezoben irnak
        $('#chatInput_main').on('input', function() {
            if (targetUserId){
             markMessagesAsRead(uid,targetUserId); 
            }
        });

        // Esemeny, amikor entert nyomnak az input mezoben
         $('#chatInput_main').on('keydown', function(event) {
            if (event.key === 'Enter') {
                if (targetUserId){
                 markMessagesAsRead(uid,targetUserId); 
            }
                
            }
       });
        
      
    }
 });



function closeChatWindow_main() {
    $('#chatBox').css('display', 'none');
    clearInterval(intervalId_main);
    clearInterval(interval_lastactive_main);

    $.ajax({
        type: 'POST',
        url: '/image/chat/update_chat_status.php',
        data: { users_chats_id: uid, status: 'closed' },
        success: function(response) {
            // Opcio: kezelheted a valaszt itt, ha szukseges
         
        },
        error: function(xhr, status, error) {
            // Opcio: kezelheted az esetleges hibakat itt
            console.error('Failed to update chat status:', error);
        }
    });
    
}

function closeChatWinState() {
    $('#chatBox').css('display', 'none');
    clearInterval(intervalId_main);
    clearInterval(interval_lastactive_main);
   
}




function archived_input_disabled(){
    if (targetUserId === null) {
        return; 
    }
    
    if (!targetUserId){
        return; 
    } 

 
    if (document.getElementById('chat_state').value == 'archived') {
    var chat_inp = document.getElementById('chatInput_main');
    chat_inp.value = 'Change to ACTIVE!';
    chat_inp.setAttribute('style', 'color:red !important');

      chat_inp.addEventListener('blur', function() {
        chat_inp.setAttribute('style', 'color:#fff !important');
        chat_inp.value='';
     });
   }
}

/*
function linkDetector(message) {
  const urlPattern = /(https?:\/\/[^\s]+)/g;
  const newLinkMessage = message.replace(urlPattern, '<a href="$1" target="_blank">$1</a>');
  return newLinkMessage;
}
  */

function linkDetector(message) {
  const urlPattern = /(https?:\/\/[^\s]+|www\.[^\s]+)/g;
  const newLinkMessage = message.replace(urlPattern, function(url) {
    // Ellenőrizzük, hogy http:// vagy https://-el kezdődik-e
    if (!url.startsWith("http://") && !url.startsWith("https://")) {
      // Ha nem, akkor http://-t adunk hozzá
      return '<a href="http://' + url + '" class="chat-link" target="_blank">' + url + '</a>';
    } else {
      return '<a href="' + url + '" class="chat-link" target="_blank">' + url + '</a>';
    }
  });
  return newLinkMessage;
}


$(document).ready(function () {
    // Enter billentyű lenyomására küldés
    document.getElementById('chatInput_main').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Küldés gomb kattintására küldés
    document.getElementById('sendMessage').addEventListener('click', function () {
        sendMessage();
    });
});


function sendMessage(targetChatId,system) {
if (targetChatId){targetUserId=targetChatId;}

if (targetUserId === null) {
alert('Please select a user to chat with.');
return;
}
 
if (typeof targetUserId == 'undefined') {
    alert('Please select a user to chat with.');
    return;
}

 
if ((!system) && (document.getElementById("chatInput_main").value == '[SYSTEM]:JOINED') ) {               
alert('This is a system-reserved message! \n You cannot use! Try again.');
document.getElementById('chatInput_main').value ='';
return;
}

if ((!system) && (document.getElementById("chatInput_main").value == '[SYSTEM]:LEFT') ) {               
alert('This is a system-reserved message! \n You cannot use! Try again.');
document.getElementById('chatInput_main').value ='';
return;
}


if (document.getElementById("chat_state").value == 'archived'){
alert('Change your status to ACTIVE \n  (in the option ⚙ top right)');
document.getElementById('chatInput_main').value ='';
return;
}

var message = $('#chatInput_main').val();
if (message.trim() !== '') {
 message = linkDetector(message);

$.ajax({
    type: 'POST',
    url: '/image/chat/send_message.php',
    data: {
        message: message,
        to_users_chats_id: targetUserId,
        uid: uid,
    },
   
        success: function(response) {
  console.log("Message sent successfully", response);

  // Sikeres küldés esetén töröljük az input mező tartalmát
  $('#chatInput_main').val('');

  // Frissítjük az utolsó üzenet ID-ját a szerver válasza alapján
  if (response.last_message_id) {
    lastMessageId = response.last_message_id;
  }

  // Az új üzenetet már a loadMessages_main fogja betölteni,
  // így itt nem kell hozzáadnunk manuálisan a chat-boxhoz.

  // Az üzenetek újratöltése (csak az újak)
  loadMessages_main(); 

  // Görgetés az aljára (ezt a loadMessages_main-ben is elvégezzük, de itt is meghagyjuk a biztonság kedvéért)
  $('#chatMessages_main').scrollTop($('#chatMessages_main')[0].scrollHeight);
},


    error: function(xhr, status, error) {
        console.error('Message sending failed:', error);
    }
});
}
}




lastMessageId = 0;
function loadMessages_main() {
  if (targetUserId === null || !targetUserId) {
    return;
  }

  $.ajax({
    type: 'GET',
    url: '/image/chat/load_messages.php',
    data: { to_users_chats_id: targetUserId, uid: uid, last_message_id: lastMessageId },
    success: function(response) {
      var chatMessages_main = $('#chatMessages_main');

      if (chatMessages_main.length === 0 || chatMessages_main[0] === undefined) {
        return;
      }

      var oldScrollHeight = chatMessages_main[0].scrollHeight;
      var isAtBottom =
        chatMessages_main[0].scrollHeight - chatMessages_main[0].scrollTop ===
        chatMessages_main[0].clientHeight;

      // Üzenetfeldolgozó rész
      let messages = response.messages;
      let lastSender = ''; 

      // Az utolsó üzenet feladójának meghatározása a chatMessages_main utolsó eleméből
      let lastMessage = chatMessages_main.children().last();
      if (lastMessage.length > 0){
        if (lastMessage.hasClass('self')){
            lastSender = 'self';
        } else if (lastMessage.hasClass('partner')){
            lastSender = 'partner';
        }
      }

      messages.forEach(function(msg) {
        if (
          msg.message == '[SYSTEM]:LEFT' ||
          msg.message == '[SYSTEM]:JOINED'
        ) {
          // Rendszerüzenetek kezelése (változatlan)
          var systemMessage = $('<div>')
            .addClass('message-system')
            .text(msg.message)
            .css({
              'text-align': 'center',
              'font-size': '12px',
              'margin': '10px auto',
              'color': 'rgb(176, 171, 166)',
              'background-color': '#293846',
              'border-radius': '20px',
              'padding': '5px 10px',
              'max-width': '30%',
              'clear': 'both',
              'display': 'flex',
              'justify-content': 'center',
            });
          chatMessages_main.append(systemMessage);
        } else {
          // Normál üzenetek kezelése
          var messageWrapper = $('<div>').addClass('message-wrapper');
          var messageDiv = $('<div>').addClass('message');

          var metaDiv = $('<div>')
            .addClass('message-meta')
            .css({
              'font-size': 'smaller',
              color: 'gray',
            });

          var timestamp = $('<span>').text(msg.timestamp);
          metaDiv.append(timestamp);

          if (msg.from_users_chats_id == uid) {
            // Saját (self) üzenet
            messageWrapper.addClass('self');
            messageDiv.addClass('self');

            // Dátum (meta-tag) megjelenítése, ha:
            // 1. VAGY a lastSender üres (első üzenet) VAGY a lastSender nem 'self' (felhasználóváltás)
            if (lastSender === '' || lastSender !== 'self') {
              metaDiv.addClass('always-visible');
            }
          } else {
            // Partner üzenete
            messageWrapper.addClass('partner');
            messageDiv.addClass('partner');

            // Dátum (meta-tag) megjelenítése, ha:
            // 1. VAGY a lastSender üres (első üzenet) VAGY a lastSender nem 'partner' (felhasználóváltás)
            if (lastSender === '' || lastSender !== 'partner') {
              metaDiv.addClass('always-visible');
            }
          }

          var messageContent = $('<span>').html(msg.message);
          messageDiv.append(metaDiv);
          messageDiv.append(messageContent);
          messageWrapper.append(messageDiv);
          chatMessages_main.append(messageWrapper);

          // Aktuális küldő beállítása a következő üzenethez
          lastSender = msg.from_users_chats_id == uid ? 'self' : 'partner';
        }
      });

      // Görgetés az aljára (változatlan)
      if (chatMessages_main[0].scrollHeight > oldScrollHeight || isAtBottom) {
        chatMessages_main.scrollTop(chatMessages_main[0].scrollHeight);
      }

      // Utolsó üzenet ID-jának frissítése (változatlan)
      lastMessageId = response.last_message_id;
    },
    error: function(xhr, status, error) {
      console.error('Failed to load messages:', error);
      console.log(xhr.responseText);
    },
  });
}

function updateChatHeader_main() {
  if (targetUserId === null) {
      return;
  }
  
  //markMessagesAsRead();

  $.ajax({
      type: 'GET',
      url: '/image/chat/get_user_info.php',
      data: { users_chats_id: targetUserId },
      dataType: 'json', // Valasz JSON formatumban
     success: function(response) {
    if (response.img_name != '') {
        var avatar = response.img_name;
    } else {
        var avatar = '/image/chat/icons/forum_face_img.jpg';
    }
    var username = response.username;
    var lastActive = response.last_active;

    var ins = '<img src="/image/img_user/' + avatar + '" alt="face" width="40" height="40" class="commentuser">';
    $('#chatUser_main').html('<table class="chatUserAvatar"><tr><td>'+ins + '</td><td class="chatUserName">' + username+'</td></tr></table>');
    if (lastActive!='') { 
       $('#chatTime_main').html('LAST ACTIVE<br>' + lastActive);
    }else{
        $('#chatTime_main').html(''); 
    }

    $('#chatOptions').html('<span style="font-size:20px;" onclick="chat_options(event)"><img src="/image/chat/icons/chatOption_blue5.png" alt="option" width="18" height="18"></span>');
    
    
},
      error: function(xhr, status, error) {
          console.error('Failed to update chat header:', error);
      }
  });
//-----------------------------------------------------------
//chat-user allopot megallapitas:
 document.getElementById("chatpartner_id").value = targetUserId;

$.ajax({
    type: 'POST',
    url: '/image/chat/chatpartner_state.php',
    data: {
        targetUserId: targetUserId,
        uid: uid,
    },
    success: function(response) {
   // console.log(response);
   
    document.getElementById("chat_state").value = response.trim().replace(/[^\x20-\x7E]/g, ''); 
    
   
 
    },
    error: function(xhr, status, error) {
        console.error('Message sending failed:', error);
    }
});



//----------------------------------

}



function updateLastActive_main() {
  $.ajax({
      type: 'POST',
      url: '/image/chat/update_last_active.php',
      data: { users_chats_id: uid },
      success: function(response) {
        //  console.log('Last active updated successfully.');
      },
      error: function(xhr, status, error) {
          console.error('Failed to update last active:', error);
      }
  });
}


//chat OPTION (header-ben)-----------------------------------------------------------------
function chat_options(event) {
  if (!event) {
    console.error("Event object is not defined");
    return;
  }

   
  // Ellenőrizd, hogy létezik-e már a popup
  let popupMenu = document.getElementById("popupMenu");
  if (!popupMenu) {
    // Popup létrehozása
    popupMenu = document.createElement("div");
    popupMenu.id = "popupMenu";
    popupMenu.style.position = "fixed"; // FIXED pozíció a görgetés megelőzésére
    popupMenu.style.width = "190px";
    popupMenu.style.background = "#25262b";
    popupMenu.style.color = "#ccc";
    //popupMenu.style.border = "1px solid #717171";
    popupMenu.style.border = "1px solid #343332";
    popupMenu.style.borderRadius = "6px";
    popupMenu.style.opacity = "1";
    popupMenu.style.boxShadow = "0px 4px 6px rgba(0,0,0,0.1)";
    popupMenu.style.display = "none";
    popupMenu.style.zIndex = "999001"; // Magas z-index a megjelenítéshez

    document.body.appendChild(popupMenu);

    // Stílus az opciókhoz
    const style = document.createElement("style");
    style.innerHTML = `
      #popupMenu .popup-item {
        padding: 5px;
        cursor: pointer;
        text-align: center;
       
      }
      #popupMenu .popup-item:hover {
        background-color: 2d2e33;
        border-radius:6px ;
      }
    `;
    document.head.appendChild(style);
  }

  // Ellenőrizzük az állapotot
  const chatStateElement = document.getElementById("chat_state");
  if (!chatStateElement) {
    console.error("chat_state element not found");
    return;
  }
  
  const chatState = chatStateElement.value; // Az aktuális állapot
  let header = "";
  let optionLabel = "";
  let optionOnClick = "";

  if (chatState === "active") {
    header = "ACTIVE";
    optionLabel = " <table class='popup-item' style='color:#ef4343; margin-left:36%;font-size: 14px;'><tr><td>Leave&nbsp;&nbsp;</td><td><img src='/image/chat/icons/leave_chat.png' alt='leave' width='20' height='20'></td></tr></table>";
    optionOnClick = "optionTwo()";
    
  } else if (chatState === "archived") {
    header = "ARCHIVED";
    optionLabel = "<table class='popup-item' style='color:#389b38;font-size: 14px; margin-left:35%;'><tr><td>Rejoin&nbsp;</td><td><img src='/image/chat/icons/join_chat.png' alt='join' width='20' height='20'></td></tr></table>";
    optionOnClick = "optionOne()";
  } else {
    console.error(`Unexpected chat state: ${chatState}`);
    return;
  }


  //kivedtem a delete-et, --> csak akkor jelenjen meg, ha 'archive'
  deleteDiv = `
 <div class="popup-item" style="color:#ef4343;font-size: 14px; padding:8px; height:35px;  ${chatState === 'active' ? 'pointer-events: none; opacity: 0.5;' : ''}" onclick="${chatState === 'active' ? '' : 'optionThree()'}">
    <table class="popup-item" style='color:#ef4343; margin-left:35%;font-size: 14px;'><tr><td>Delete&nbsp;&nbsp;</td><td><img src='/image/chat/icons/delete_chat.png' alt='delete_chat' width='12' height='12'></td></tr></table>
  </div>
`;

  // Popup tartalmának frissítése az aktuális állapot szerint
popupMenu.innerHTML = `
  <div id="popupHeader" style="height:35px; padding:8px; color:gray;font-weight: bold; background-color: rgb(30, 32, 36); border-radius: 6px 6px 0px 0px; text-align: center;">
    ${header}
  </div>
  <div class="popup-item" style=" padding:8px; font-size: 14px; height:35px; color:lightgray;" id="option_label01" onclick="${optionOnClick}">${optionLabel}</div>
  ${ chatState === "archived" ? deleteDiv: '' }
  <div class="popup-item" style="color:#ef4343; font-size: 14px; padding:6px; height:35px;" onclick="optionFour()"><table class="popup-item" style='color:#ef4343; margin-left:35%; font-size: 14px;'><tr><td>Report</td><td><img src='/image/chat/icons/report_chat.png' alt='report_chat' width='22' height='22'></td></tr></table></div>
    
`;


  // Pozíció és megjelenítés
  const rect = event.target.getBoundingClientRect();
  popupMenu.style.top = `${rect.bottom}px`; // FIXED pozícióhoz relatív a képernyőhöz
  popupMenu.style.left = `${rect.left}px`;
  popupMenu.style.display = popupMenu.style.display === "block" ? "none" : "block";

  //popupMenu.style.top = `150px`; 
  //popupMenu.style.left = `395px`;


  // Bezárás külső kattintásra
  document.addEventListener("click", function closePopup(e) {
    if (!popupMenu.contains(e.target) && e.target !== event.target) {
      popupMenu.style.display = "none";
      document.removeEventListener("click", closePopup);
    }
  });
}





//Active
function optionOne() {
  
   

$.ajax({
      url: '/image/chat/insert_active_option.php',
      method: 'POST',
      data: {
          uid: uid, targetUserId: targetUserId
      
      },
      success: function(response_chat) {
         // console.log(response_chat);    
      },
      error: function(xhr) {
          console.error('Failed to update chat status:', xhr.responseText);
      }
      });
      
   loadUserList_active();
   loadUserList_archived();
   document.getElementById("chat_state").value='active';
   chat_options(event);
   popupMenu.style.display = "block";
 //----inputba(  archived --> active  )----------- 
   $('#chatInput_main').val('[SYSTEM]:JOINED');
   sendMessage('',1);


}

//Archived
function optionTwo() {
    

  $.ajax({
        url: '/image/chat/insert_archived_option.php',
        method: 'POST',
        data: {
            uid: uid, targetUserId: targetUserId
        
        },
        success: function(response_chat) {
           // console.log(response_chat);    
        },
        error: function(xhr) {
            console.error('Failed to update chat status:', xhr.responseText);
        }
        });

      
        loadUserList_archived();
        loadUserList_active();
        
        chat_options(event);
        popupMenu.style.display = "block";
       //----inputba(active --> archived)-----------  
       $('#chatInput_main').val('[SYSTEM]:LEFT');
       //sendMessage();
       sendMessage('',1);
       document.getElementById("chat_state").value='archived';
        

}

// Delete
function optionThree() {

    // Megerosito parbeszedablak
    const confirmation = confirm("Are you sure you want to delete this chat?");
    if (!confirmation) {
        return; // Ha a felhasznalo nem erositi meg, kilepunk.
    }

    $.ajax({
        url: '/image/chat/delete_chat_option.php',
        method: 'POST',
        data: {
            uid: uid,
            targetUserId: targetUserId
        },
        success: function(response_chat) {
           // console.log(response_chat);    
        //   document.getElementById("chat_state").value='';
       
            // Felhasznaloi lista ujratoltese
               loadUserList_archived();
               loadUserList_active();

        },
        error: function(xhr) {
            console.error('Failed to update chat status:', xhr.responseText);
        }
        
       
        
    });

   
        chat_options(event);
        popupMenu.style.display = "block";
        document.getElementById("chat_state").value='';
        document.getElementById('chatInput_main').value='';
        targetUserId=null;

    $.ajax({
        type: "post",
        url: '/image/chat/load_chatContent_main.php',
        data: {},
        success: function(data_chat_win) {
            $('#chat_win').html(data_chat_win);
        }
    });

}

// Report
function optionFour() {
 alert('Here will be the report.');

}    




//end:chat-option-----------------------------




 /*---------------------------end:chat---------------------------------*/






</script>