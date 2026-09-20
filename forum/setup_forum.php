


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Search</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<style> 

body {
    background-color: #2d2e33;
    color: white;
    font-family: 'Arial', sans-serif;
   // text-align: center;
}

.container {
    padding: 20px;
}

h3 {
    color: #fc7d48;
    font-size: 1.2em;
    margin-bottom: 10px;
}

#search_user {
    height: 25px;
    width: 750px;
    background-color: black;
    color: white;
    font-weight: 500;
    font-size: 18px;
    border: 1px solid #fc7d48;
    border-radius: 5px;
    padding: 5px;
}

#result_user {
    height: 25px;
    width: 750px;
    color: white;
    font-weight: 500;
    font-size: 16px;
    margin-top: 10px;
}

.panel_ordered {
            width: 700px;
             border: 1px solid gray;
             border-radius: 5px;
             padding: 5px;

            height: 50px;
            background-color: #37383d;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .toggle-button-odered {
            border: 1px solid #181c19;
            border-radius: 2px;
            height: 33px;
            background-color: gray;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
        }
        .toggle-button-odered.active {
           border: 1px solid gray;
            border-radius: 2px;
            font-weight: 500;
            font-size: 16px;
            height: 33px;
            background-color:orange;
      }
.panel_user { 
             width: 700px;
             border: 1px solid gray;
             border-radius: 5px;
             padding: 5px;
             height: 50px;
             background-color: #37383d;
        //     display: flex;
             align-items: center;
             justify-content: space-around;   
             height:300px;
}

        .toggle-btn-clean {
            border: 1px solid #181c19;
            border-radius: 2px;
            height: 33px;
            background-color:gray;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            width:120px;
        }
        .toggle-btn-clean.active {
           border: 1px solid gray;
            border-radius: 2px;
            font-weight: 500;
            font-size: 16px;
            height: 33px;
            background-color:red;
      }


[class^="forum_tooltip"] {
  position: relative;
}

/* tooltip */ 
.forum_tooltip--left::after {
  opacity: 0;
  visibility: hidden;
  position: absolute;
  content: attr(data-tooltip);
  padding: 2px 3px;
  bottom: 1.4em; 
  left: 50%;
  transform: translateX(-50%) translateY(-2px);
  background: #161617; 
  color: white;
  white-space: pre-line;
  z-index: 2;
  border-color: #37383d;
  border-radius: 2px;
  transition: opacity 0.2s ease, transform 0.2s ease;
  font-size: 12px;
}
.forum_tooltip--left:hover::after {
  display: block;
  opacity: 0.7;
  visibility: visible;
  transform: translateX(50%) translateY(10% ); /* Modosotva: tooltip felfele novekszik */
  width:280px;
  border-radius: 10px;
  padding:10px;
}


.forum_tooltip--left:hover{
  background-color: #161617; border-radius: 10px; 
  width:240px;
}

</style>

<body>
         <h1>Forum Image Setup</h1> 
<div style="background-color:#2d2e33; height:500px;padding-top:40px;padding-left:20px;">
    
     
     <!-- comment order panel-->
     <div style="margin-bottom:40px;padding:20px;">
        <h5 style='color:#0f6bd3;' class='forum_tooltip--left' data-tooltip='Here you can set the default order of comments. Click on the buttons, and after the update, the comments will be in the new order.'>1. Comment Order Setup</h5>
        <br>
        
       <div class="panel_ordered">
     
        <button class="toggle-button-odered" id="best">Best</button>
        <button class="toggle-button-odered" id="latest">Latest</button>
        <button class="toggle-button-odered" id="oldest">Oldest</button>
     </div>                                              
                                                       
  </div>  
  
      <!--  cleanFolder panel-->
       <div style="margin-bottom:40px;padding:20px;">
        <h5 style='color:#0f6bd3;' class='forum_tooltip--left' data-tooltip='Here you can delete unused, unnecessary images from the File Uploads folder. Pressing the Clean All button will delete unused images for the entire database. '>2. Clean Upload Files</h5>
        <br>
        
       <div class="panel_ordered">
     
        <button class="toggle-btn-clean" onclick="cleanFolderImg()" id="clean_all">Clean All</button>
        <button class="toggle-btn-clean" id="clean">Clean</button>
       
     </div>                                              
                                                       
  </div>   
  
                                                 
         <!--  User Level ------------------->
   
   <div style="margin-bottom:40px;padding:20px;">
        <h5 style='color:#0f6bd3;' class='forum_tooltip--left' data-tooltip='Here you can grant deletion/modification rights to Forum users. This panel sets the User Level to "5" for users. The checkbox tick can be used to change the value.'>3. User Level Setup</h5>
         <br>
        <div class="panel_user" style="padding:20px;">
       
        
        <input type="text" style="height:25px;width:650px; background-color:black;color:white;font-weight: 500; font-size: 18px;"  id="search_user" placeholder="Write a User Name...">
        <div  style="height:25px;width:650px; color:white;font-weight: 500; font-size: 16px;" id="result_user"></div>
      </div>
   </div>
</div> 

    <script>
    
//---user_level beallitasa------------------------------------------------------    
        $(document).ready(function() {
            $('#search_user').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'forum/setup_search.php',
                        method: 'POST',
                        data: {query: query},
                        success: function(data) {
                            $('#result_user').html(data);
                        }
                    });
                } else {
                    $('#result_user').html('');
                }
            });

            $(document).on('change', '.user-level-checkbox', function() {
                var userId = $(this).data('id');
                var isChecked = $(this).is(':checked');
                var userLevel = isChecked ? 5 : 0;
              
           //   var confirmText = "Are you sure you want to update?";
           //  if(confirm(confirmText)) {
              
                $.ajax({
                    url: 'forum/setup_user_level.php',
                    method: 'POST',
                    data: {userId: userId, userLevel: userLevel},
                    success: function(response) {
                
                     
                      // Frissítjük az eredményt AJAX-szal
                      $.ajax({
                          url: 'forum/setup_search.php',
                          method: 'POST',
                          data: {query: $('#search_user').val()},
                          success: function(data) {
                              $('#result_user').html(data);
                          }
                      }); 
                       alert("User Level Updated");
                  }
                     
                });
       
            //  }
          });
     
       });


 //----kommentek sorrendje------------------------------------------------------   
   $(document).ready(function() { 
     const orderedButtons = document.querySelectorAll('.toggle-button-odered');
        let ordered = '';

        orderedButtons.forEach(button => {
            button.addEventListener('click', () => {
                orderedButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                ordered = button.id;
                console.log('Ordered:', ordered);
   
                $.ajax({
                  url: 'forum/setup_updOrder.php',
                  method: 'POST',
                  data: {ordered: ordered},
                  success: function(response) {
                  alert('Comment order updated: '+response);
                      // Frissítjük az eredményt AJAX-szal
 
                  }
                });
   
            });
        });
    
    }); 
          
//kepek torlese------------------------------------------

function cleanFolderImg(){
 var btn_clean =  document.getElementById("clean_all");
  btn_clean.classList.add('active');

      var send_commit="accept";
          $.ajax({
              type : "post",
              url:'forum/setup_cleanFolder.php',
              data: {
              send_commit: send_commit,
           
              }, // pass data 
              success:function(result_clean) { 
               console.log(result_clean);
               alert(result_clean);
               btn_clean.classList.remove('active');
              }
         });
  
}
  
//----------------    
    
    
    
    </script>
</body>
</html>



