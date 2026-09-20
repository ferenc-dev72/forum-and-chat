<?php
session_start(); 


?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./chat-categories.css" rel="stylesheet" /> 
    <title>Chat Rendszer</title>
   
</head>
<body>
       



<div class="chat-box-image" id="chatBox">
    <div class="chat-header" id="chatHeader">
        <span class="chatname" id="chatUser">Chat</span>
        <span class="chat-Time" id="chatTime">Chat</span>
        <button class="close-chat" id="closeChat"><img src='/image/chat/icons/close_red.png' alt='close' width='25' height='25'></button>
    </div>
    <div class="chat-messages chatMessage_scroll" id="chatMessages">
       
    </div>

    <div class="input-container">
    <input type="text" id="chatInput" class="chat-input" placeholder="Write a message...">
    <div class="icon-container">
       <!--  <button id="addLink">&#128279;</button> Link ikon -->
        <button id="addEmoji">&#128512;</button> <!-- Mosolygos ikon -->
        &nbsp;&nbsp;&nbsp;
        <button id="sendMessage_creator"><img src='/image/chat/icons/submit.png' alt='join' width='30' height='30'></button> <!-- Kuldes gomb -->
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

</body>
</html>



<script>
/*chat---------------------------------------------------------------------------------------------------*/

 //chat ikonra katt --> (userhash) -->  target_uid megfhatarozashoz 
 
 var userHash_chat = $('.creator-page-text07').data('userhash-creator');

 //var accept_loadmessage =""; 

   
    var chatBox = document.getElementById('chatBox');
    var chatInput = document.getElementById('chatInput');


    //interval valtozok declaralasa (idokozonkenti xml-keres)  
if (typeof interval_lastactive === 'undefined') {
    var interval_lastactive;
}


if (typeof intervalId === 'undefined') {
    var intervalId;
}



  $(document).ready(function(){

        $('#addEmoji').click(function() {
                $('#emojiPicker').toggle();
            });

            // Add selected emoji to input
            $('#emojiPicker span').click(function() {
                var emoji = $(this).text();
                $('#chatInput').val($('#chatInput').val() + emoji);
                $('#emojiPicker').hide();
            });

            // Toggle link input
            $('#addLink').click(function() {
                var link = prompt('Enter the link URL:');
                if (link) {
                    var text = prompt('Enter the link text:');
                    if (text) {
                        var currentText = $('#chatInput').val();
                        var newText = `<a href="${link}" target="_blank">${text}</a>`;
                        $('#chatInput').val(currentText + newText);
                    }
                }
            });



    if ( (typeof chatBox === 'undefined') || (chatBox == null) ) {
      chatBox='';
    }
    if ( (typeof chatInput === 'undefined') || (chatInput == null) ) {
      chatInput='';
    }



//chat id lekeres:  uid = chat_user_id
$.ajax({     
  url: '/image/chat/chat_user_id.php', 
  success: function(data) {
    uid = data;  
    uid = uid.trim().replace(/[^\x20-\x7E]/g, ''); 
    begin_chat();

  }
});


 // Az esemenykezelot jQuery-vel hozzuk letre
 $('#closeChat').on('click', function() {
  closeChatWindow();
  });
  

  $.ajax({
       type: "post",
       url: '/image/chat/get_archived_user.php',
       data: {
       // tuid: tuid
       },
       success: function(data_id) {
        archived_chatids = data_id;  
        archived_chatids = archived_chatids.trim().replace(/[^\x20-\x7E]/g, ''); 
      }
});


$.ajax({
       type: "post",
       url: '/image/chat/get_deleted_user.php',
       data: {
       },
       success: function(deleted_data_id) {
        deleted_chatids = deleted_data_id;  
        deleted_chatids = deleted_chatids.trim().replace(/[^\x20-\x7E]/g, ''); 
        //alert(deleted_chatids);      
       }
});



  if ( (typeof lastMessageId_creator === 'undefined') || (lastMessageId_creator == null) ) {
    lastMessageId_creator=0;
  }


});



function begin_chat(){

//target userid lekerese: target_uid 
$.ajax({
        type: "post",
        url: '/image/chat/target_user_id.php',
        data: {
         userHash_chat: userHash_chat
        },
        success: function(data_id) {
          target_uid = data_id;  
          target_uid = target_uid.trim().replace(/[^\x20-\x7E]/g, ''); 
          setTargetUserId_image(target_uid); // begin chat!
        }

 });
 
}





function setTargetUserId_image(target_uid) {
    targetUserId = target_uid;
 //   document.getElementById('userSelectWindow').style.display = 'none';
   if (targetUserId){
        lastMessageId_creator = 0;
        openChatWindow();
        loadMessages(); // Betolti az uzeneteket
        updateChatHeader(); // Frissiti a chat fejlecet
   }

}



function openChatWindow() {
$('#chatBox').show(); // Beallitja a chatBox-ot lathatova
intervalId = setInterval(loadMessages, 3000);

interval_lastactive = setInterval(updateLastActive, 30000);
$.ajax({
url: '/image/chat/update_chat_status.php',
method: 'POST',
data: {
    users_chats_id: uid,
    status: 'open'
},
success: function(response) {
    // Sikeresen friss�tette a st�tuszt, tov�bbi m�veletek itt, ha sz�ks�ges
    markMessagesAsRead(); // �zenetek olvasott� t�tele
},
error: function(xhr) {
    console.error('Failed to update chat status:', xhr.responseText);
}
});
}



function markMessagesAsRead() {
  if ($('#chatBox').css('display') === 'block') {
        $.ajax({
            type: 'POST',
            url: '/image/chat/mark_messages_read.php',
            data: { users_chats_id: uid },
            success: function(response) {
                // Opci�: kezelheted a v�laszt itt, ha sz�ks�ges
                //console.log('Messages marked as read.');
            },
            error: function(xhr, status, error) {
                // Opci�: kezelheted az esetleges hib�kat itt
                console.error('Failed to mark messages as read:', error);
            }
        });
  }
}



 $(document).ready(function(){

     if (chatBox != '') { 
         chatBox.addEventListener('click', function() {
         markMessagesAsRead();
        });
     }
 });

function closeChatWindow() {
    
    $('#chatBox').css('display', 'none');
    
    clearInterval(intervalId);
   
    clearInterval(interval_lastactive);

    $.ajax({
        type: 'POST',
        url: '/image/chat/update_chat_status.php',
        data: { users_chats_id: uid, status: 'closed' },
        success: function(response) {
            // Opci�: kezelheted a v�laszt itt, ha sz�ks�ges
           // console.log('Chat status updated to closed.');
         
        },
        error: function(xhr, status, error) {
            // Opci�: kezelheted az esetleges hib�kat itt
            console.error('Failed to update chat status:', error);
        }
    });
}


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
    document.getElementById('chatInput').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Küldés gomb kattintására küldés
    document.getElementById('sendMessage_creator').addEventListener('click', function () {
        sendMessage();
    });
});


function sendMessage() {
if (targetUserId === null) {
alert('Please select a user to chat with.');
return;
}

if (document.getElementById("chatInput").value == '[SYSTEM]:JOINED') {               
alert('This is a system-reserved message! \n You cannot use! Try again.');
document.getElementById('chatInput').value ='';
return;
}

if (document.getElementById("chatInput").value == '[SYSTEM]:LEFT') {               
alert('This is a system-reserved message! \n You cannot use! Try again.');
document.getElementById('chatInput').value ='';
return;
}

if (archived_chatids.includes(targetUserId)){
alert('Change your status to ACTIVE \n  (in the option ⚙ main chat-top right)');
document.getElementById('chatInput').value ='';
return;
}

if (deleted_chatids.includes(targetUserId)){
alert('Your status is DELETED');
document.getElementById('chatInput').value ='';
return;
}


var message = $('#chatInput').val();
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
$('#chatInput').val('');

// Frissítjük az utolsó üzenet ID-ját a szerver válasza alapján
if (response.last_message_id_creator) {
  lastMessageId_creator = response.last_message_id_creator;
}

// Az új üzenetet már a loadMessages_main fogja betölteni,
// így itt nem kell hozzáadnunk manuálisan a chat-boxhoz.

// Az üzenetek újratöltése (csak az újak)
loadMessages(); 

// Görgetés az aljára (ezt a loadMessages_main-ben is elvégezzük, de itt is meghagyjuk a biztonság kedvéért)
$('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
    },
    error: function(xhr, status, error) {
        console.error('Message sending failed:', error);
    }
});
}
}


/*
function loadMessages() {

 if (targetUserId === null) {
return;
}

$.ajax({
type: 'GET',
url: '/image/chat/load_messages.php',
data: { to_users_chats_id: targetUserId, uid: uid },
//dataType: 'json', // V�lasz JSON form�tumban
success: function(messages) {
   // console.log(messages);
  var chatMessages = $('#chatMessages');
    var isAtBottom = chatMessages[0].scrollHeight - chatMessages[0].scrollTop === chatMessages[0].clientHeight;
    
    chatMessages.empty(); // T�r�lj�k a megl�v� �zeneteket

    messages.forEach(function(msg) {
     // console.log(msg);  
      var messageDiv = $('<div>').addClass('message');
       
      if (msg.from_users_chats_id == uid) {
            messageDiv.addClass('self');
        } else {
            messageDiv.addClass('partner');
        }
        
        if ((msg.message == "[SYSTEM]:LEFT") || (msg.message == "[SYSTEM]:JOINED")) { messageDiv.addClass('leftJoin');}

        var messageContent = $('<span>').text(msg.message);

        var messageMeta = $('<span>').css({
            'font-size': 'smaller',
            'color': 'gray'
        }).text(` (${msg.is_read ? 'Read' : 'Unread'}) - ${msg.timestamp}`);

      //  messageDiv.append(messageContent);
      //  messageDiv.append(messageMeta);
      //  chatMessages.append(messageDiv);
        
            if (!messageDiv.hasClass('leftJoin')) {
                messageDiv.append(messageContent);
                messageDiv.append(messageMeta);
                chatMessages.append(messageDiv);
            } else {
                messageDiv.append(messageContent);
                chatMessages.append(messageDiv);
            }

        
    });

    if (isAtBottom) {
        chatMessages.scrollTop(chatMessages[0].scrollHeight);
    }
},
error: function(xhr, status, error) {
    console.error('Failed to load messages:', error);
}
});
}
*/


lastMessageId_creator = 0;
function loadMessages() {
  if (targetUserId === null || !targetUserId) {
    return;
  }

  if (archived_chatids.includes(targetUserId)){  
      return;
  }

  if (deleted_chatids.includes(targetUserId)){  
      return;
  }

  $.ajax({
    type: 'GET',
    url: '/image/chat/load_messages_creator.php',
    data: { to_users_chats_id: targetUserId, uid: uid, last_message_id_creator: lastMessageId_creator },
    success: function(response) {
      var chatMessages = $('#chatMessages');

      if (chatMessages.length === 0 || chatMessages[0] === undefined) {
        return;
      }

      var oldScrollHeight = chatMessages[0].scrollHeight;
      var isAtBottom =
        chatMessages[0].scrollHeight - chatMessages[0].scrollTop ===
        chatMessages[0].clientHeight;

      // Üzenetfeldolgozó rész
      let messages = response.messages;
      let lastSender = ''; 

      // Az utolsó üzenet feladójának meghatározása a chatMessages utolsó eleméből
      let lastMessage = chatMessages.children().last();
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
              'max-width': '35%',
              'clear': 'both',
              'display': 'flex',
              'justify-content': 'center',
            });
          chatMessages.append(systemMessage);
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
          chatMessages.append(messageWrapper);

          // Aktuális küldő beállítása a következő üzenethez
          lastSender = msg.from_users_chats_id == uid ? 'self' : 'partner';
        }
      });

      // Görgetés az aljára (változatlan)
      if (chatMessages[0].scrollHeight > oldScrollHeight || isAtBottom) {
        chatMessages.scrollTop(chatMessages[0].scrollHeight);
      }

      // Utolsó üzenet ID-jának frissítése (változatlan)
      lastMessageId_creator = response.last_message_id_creator;
    },
    error: function(xhr, status, error) {
      console.error('Failed to load messages:', error);
      console.log(xhr.responseText);
    },
  });
}

function updateChatHeader() {
  if (targetUserId === null) {
      return;
  }

  $.ajax({
      type: 'GET',
      url: '/image/chat/get_user_info.php',
      data: { users_chats_id: targetUserId },
      dataType: 'json', // V�lasz JSON form�tumban
     success: function(response) {
    if (response.img_name != '') {
        var avatar = response.img_name;
    } else {
        var avatar = 'forum_face_img.jpg';
    }
    var username = response.username;
    var lastActive = response.last_active;

    var ins = '<img src="/image/img_user/' + avatar + '" alt="face" width="40" height="40" class="commentuser">';
    $('#chatUser').html('<table class="chatUserAvatar"><tr><td>'+ins + '</td><td class="chatUserName">' + username+'</td></tr></table>');
    if (lastActive!='') { 
       $('#chatTime').html('LAST ACTIVE<br>' + lastActive);
    }else{
        $('#chatTime').html(''); 
    }
    if (archived_chatids.includes(targetUserId)){$('#chatTime').html("<p style='font-size: 14px;color: red;'>ARCHIVED</p>");
      $('#chatUser').html('<table class="chatUserAvatar"><tr><td style="color:gray;opacity:0.5;">'+ins + '</td><td  style="color:gray;opacity:0.5;" class="chatUserName">' + username+'</td></tr></table>');
    }
    if (deleted_chatids.includes(targetUserId)){$('#chatTime').html("<p style='font-size: 14px;color: red;'>DELETED</p>");
      $('#chatUser').html('<table class="chatUserAvatar"><tr><td style="color:gray;opacity:0.5;">'+ins + '</td><td  style="color:gray;opacity:0.5;" class="chatUserName">' + username+'</td></tr></table>');
    }

},
      error: function(xhr, status, error) {
          console.error('Failed to update chat header:', error);
      }
  });
}



function updateLastActive() {
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



 /*---------------------------end:chat-------------------*/






</script>