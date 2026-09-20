
  //be lepett-e
  if ((typeof resultLogin === 'undefined') || (resultLogin == null)) {
      resultLogin='';
     // alert(resultLogin+"1");
  }

  //user - avatar kep utvonala
  if ( (typeof user_img_path === 'undefined') || (user_img_path == null) ) {
     user_img_path='';
  }

  //userHash 
  if ( (typeof uHash === 'undefined') || (uHash == null) ) {
     uHash='';
  }

  //user jog szintje
  if ( (typeof userLevel === 'undefined') || (userLevel == null) ) {
      userLevel=''; 
  }


  //commentek betoltesi sorrendje
  if ((typeof ordered === 'undefined') || (ordered == null)) {
      ordered = '';
     
    
   
  }



$(document).ready(function(){
                  //be lepett-e
      $.ajax({
          url: '/image/forum/forum_username.php',    
          success: function(data) {
            resultLogin = data;  
            resultLogin = resultLogin.trim().replace(/[^\x20-\x7E]/g, ''); 
          //  alert(resultLogin);
          }
      });
                   //user jog szintje
      $.ajax({   
        url: '/image/forum/forum_userlevel.php', 
        success: function(data) {
          userLevel = data;  
          userLevel = userLevel.trim().replace(/[^\x20-\x7E]/g, ''); 
        
        }
      });
      
         $.ajax({   
        url: '/image/forum/forum_userhash.php', 
        success: function(data) {
          uHash = data;  
          uHash = uHash.trim().replace(/[^\x20-\x7E]/g, ''); 
       // alert(uHash);
        }
      });   


//user_img_path - avatarkep utvonala 
$.ajax({   
  url: '/image/forum/forum_main_input_img.php', 
  success: function(data) {
    user_img_path = data;  
    user_img_path = user_img_path.trim().replace(/[^\x20-\x7E]/g, ''); 
  //alert(user_img_path);
  }
});  

//commentek betoltesi sorrendje
$.ajax({   
  url: '/image/forum/setup_load_order.php', 
  success: function(data) {
    ordered = data;  
    ordered = ordered.trim().replace(/[^\x20-\x7E]/g, ''); 
 //alert(ordered);
 }
});

//video_upload="no";




});


 // betoltodik a user a kep betoltese utan egybol. 
 function forum_user_visible(){   
  $(document).ready(function(){
     document.getElementById("szerzo_img_002").value = resultLogin; 
     $('#szerzo_img_002').css('visibility','visible');
    // $('#btn002').show();
    // document.getElementById("img002").src = "img_user/"+user_img_path;
    // $('#img002').css('visibility','visible'); 
     updateCommentFace();
     forum_commentNumber2();
   
   
  });
}


function updateCommentFace(){
  $(".commentface").attr("src", "img_user/"+user_img_path);
 
}


 // a kommentek szama - es kiirasa az elejen (csukott panel) 
 function forum_commentNumber2() {
  var kepId = document.getElementById("img_ID").value;
    $.ajax({
      type : "post",
      url:'forum/forum_comment_number2.php',
    data: {
      kepId: kepId,
   
    }, // pass data 
    success:function(result) { 
    document.getElementById("svg_1178").innerHTML = result;
    if (result<2){document.getElementById("svg_278").innerHTML = 'comment';}
    else{document.getElementById("svg_278").innerHTML = 'comments';}
           
    // console.log(result);
    }
   });
}



  //main input panel - ha belekattint a user, a fo panel es a dolgok  megjelennek  
  $(document).ready(function(){  
    $('#before_img_input002').click(function(){
  
       if ($('#discuss_plus').is(":visible")) {  //csak ha csukva van
           forum_discuss_show(); 
       }
             
    });
});




 // discuss panel kinyitasa
function forum_discuss_show(state){
    
     var svgPlus = document.getElementById("discuss_plus");                       //"+" jel (svg)
     var svgMinus = document.getElementById("discuss_minus");                     //"-" jel (svg)
     var imgContBg = document.getElementById("img_page_cont_bg");                 //main container DIV (image-page)  
     var imgDiscus = document.getElementById("img_page_discus");                  //discussuion DIV (image-page)
     var commentsMsg = document.getElementById("msgPanel004");                    //Informacios DIV (image-page)
     var commNumbPanel = document.getElementById("writeOut_commNumb");
     // document.getElementById("forum_input01").style.display = "block";
       document.getElementById("forum_content").style.display = "block";          //forum DIV (itt vannak a commentek)
   
      
    
    if (typeof state == 'undefined') {                 //ha a user nyitoitta ki,es nem a program, akkor -> undefined
          if (svgPlus.style.display === "none") {
              svgPlus.style.display = "block";
              svgMinus.style.display = "none";
            
         } else {
           svgMinus.style.display = "block";
           svgPlus.style.display = "none";
           imgContBg.style.height = "1410px";
           summer_base();
           forum_commentNumber();                      //commentek szamanak kiirasa
           forum_updatePage(ordered);                         //update Forum - kiirodnak a commentek 
         //  forum_order_latest();
           commNumbPanel.style.display = "none";

  //NEW COMMENT----------------------------------------------------------------------------------------------------     

  $(document).ready(function() {
    
    var contentPanel = document.getElementById("forum_content");
    var plus_mark = document.getElementById('discuss_plus');
    var minus_mark = document.getElementById("discuss_minus");
    if ( (uHash != '') && (plus_mark.style.display === 'none') && (typeof contentPanel != 'undefined') )   {
       
        function clear_messagePanel005() {
            document.getElementById("msgPanel005").style.display = "none";
        }

        function checkNewComments() {
          var kepId = document.getElementById("img_ID").value;

            $.ajax({
                type: "post",
                url: 'forum/forum_newComm.php',
                data: {
                  kepId: kepId
                },
                success: function(data) {
                  if ((data) && (contentPanel.style.display === "block") ){ 
                      document.getElementById("msgPanel005").style.display = "block";
                       
                        // document.getElementById("msgPanel005_model").innerHTML = data;
                        //setTimeout(clear_messagePanel005, 5000);
                    }
                }
            });
        }

        if ( (typeof minus_mark != 'undefined') && (minus_mark.style.display === 'block') ){    
          setInterval(checkNewComments, 30000); // 30 seconds
        } 

    }

});

 //-----------------------------------------------------------------------------------------------------

           msgPanel004.style.display = "block";
       
           // document.getElementById("forum_content").style.minHeight="476px";
          document.getElementById("forum_content").style.maxHeight="475px";
          document.getElementById("forum_content").style.overflow = 'auto'; 
          document.getElementById("forum_content").style.opacity = "1";
          document.getElementById('forum_content').style.setProperty('min-height', '477px', 'important');
         
 

        }
      }else{                                            //ha a panel nyitotta/csukta ()
           
           svgMinus.style.display = "block";
           svgPlus.style.display = "none";
           imgContBg.style.height = "1410px";
           msgPanel004.style.display = "block";
           
          document.getElementById("forum_content").style.minHeight="476px";
          document.getElementById("forum_content").style.maxHeight="475px";
          document.getElementById("forum_content").style.overflow = 'auto'; 
          document.getElementById("forum_content").style.opacity = "1";
         // document.getElementById("forum_content").style.pointerEvents = "auto";
           forum_commentNumber();                       //commentek szamanak kiirasa
           forum_updatePage(ordered);                          //update Forum - kiirodnak a commentek 
           msgPanel004.style.display = "block";
      } 

} 


// discuss panel becsukasa
function forum_discuss_hide(come){
 
  var svgPlus = document.getElementById("discuss_plus");
  var svgMinus = document.getElementById("discuss_minus");
  var imgContBg = document.getElementById("img_page_cont_bg");
  var imgDiscus = document.getElementById("img_page_discus");
  var commNumbPanel = document.getElementById("writeOut_commNumb");
  if (typeof come == 'undefined') {                         //ha a user csukta be-ki (undefined)
 
      if  (svgMinus.style.display === "none") {
           svgPlus.style.display = "none";
           svgMinus.style.display = "block";
        
      } else {
           svgPlus.style.display = "block";
           svgMinus.style.display = "none";
          // imgContBg.style.height = "1410px"; // jav0410
           imgContBg.style.height = "911px"; // jav0808
           // imgDiscus.style.height = "215px";
          
           $('.summerbase').summernote('destroy');
            document.getElementById("before_img_input002").value ='';
            commNumbPanel.style.display = "block";
            forum_commentNumber2();
          // document.getElementById("forum_content").style.display = "none"; // jav0410
           document.getElementById("forum_input01").style.display = "block";
           msgPanel004.style.display = "none";
         //  document.getElementById("forum_content").style.minHeight="470px";   // jav0410
         //  document.getElementById("forum_content").style.maxHeight="475px";   // jav0410
           document.getElementById("forum_content").style.minHeight="0px";   // jav0808
           document.getElementById("forum_content").style.maxHeight="0px";   // jav0808
           document.getElementById("forum_content").style.display="none";
          
        
          }

  }else{
   //  svgPlus.style.display = "block";
   //  svgMinus.style.display = "none";
   //  imgContBg.style.height = "1410px";
              
     // document.getElementById("forum_content").style.display = "none";
      forum_updatePage();  
    
      document.getElementById("forum_input01").style.display = "block";
   //   document.getElementById("forum_content").style.opacity = "0.5";
   //   document.getElementById("forum_content").style.overflow = 'hidden';
    //  document.getElementById("forum_content").style.pointerEvents = "none";
    //  msgPanel004.style.display = "none";
      
    }
}


function removeHTMLTags(str) {
  if ((str === null) || (str === '')) return false;
  else str = str.toString();
  return str.replace(/(<([^>]+)>)/ig, '');
}


 //a main input comment elkuldese
function forum_base_submit() {  
  
  //alert(uploadedImageName);
  //alert(uploadedImagePath);
  var imageName = uploadedImageName; 
  var imagePath = uploadedImagePath;
  var base_comment = document.getElementById("before_img_input002").value;
   //var base_comment = $('#before_img_input002').summernote('code');
   //alert(base_comment);
   var kepId = document.getElementById("img_ID").value;
   var userHash = resultLogin;
   var localTime = forumFormatDate(new Date());
   var msgPanel3 = document.getElementById("msgPanel003");        
   var state='origi'; //open - close - origi
   var come = 'fromFunction';
    function clear_message() {                 //uzenet panel tartalmanak torlese
      msgPanel3.innerHTML = "";
      msgPanel3.style.display = "none";      
     }

  
    $.post('/image/forum/forum_base_insert.php', {base_comment: base_comment, kepId: kepId, localTime:localTime,  imageName: imageName, imagePath:imagePath}, function(data){

      if (base_comment == '' ) {
    //  if (removeHTMLTags(base_comment) == '' ) {
          msgPanel3.style.display = "block";  
          msgPanel3.innerHTML = "THE 'COMMENT FIELD' CANNOT BE EMPTY!";
          forum_discuss_hide(come);
          setTimeout(clear_message,3000); 
        }
    
      if ((typeof userHash == 'undefined') || (userHash == 'Guest') ) {
       //  alert('be kell jelentkezni!'); 
          msgPanel3.style.display = "block";
          msgPanel3.innerHTML = "YOU HAVE TO LOGIN FOR DISCUSSION!";
          forum_discuss_hide(come);
          setTimeout(clear_message,3000); 
       }
   
    
       if ( (typeof userHash != 'undefined') && (userHash != 'Guest') && (typeof base_comment != 'undefined') && (base_comment != '') ) { 
           var state='origi'; //open - close - origi
           forum_discuss_show(state); //base_comment ="";  
           document.getElementById("before_img_input002").value="";
     } 
    
    
       $('.summerbase').summernote('code', '');
       // $('#before_img_input002').value='';
       
      $('#forum_content').html(data);
       uploadedImageName=''; //kitoroljuk az elozo utvonalat es nevet
       uploadedImagePath=''; //kepfeltoltes utan
    
   


    }).fail(function() {
       // alert( "Posting failed." );
            
    });

}

 

 //alap - Base comment - formazas (class="summerbase")-- Textaerea -> image_page-en --------------- 
 function summer_base(){  
  
  $(document).ready(function() {
    $('.summerbase').summernote({
      placeholder: 'write here...',
      tabsize: 1,
      height: 65,
      width: 855,
      callbacks: {
        onInit: function() {
          $('.note-editable').css('background-color', '#303235');
          $('.note-editable').css('color', 'white');
        },
        onImageUpload: function(image) {
        uploadImage(image[0]);
        },
      
      }
    }); 


       // alert(image); 
         $(".summerbase").each(function() {  //text mezo - toolbar -> css beallitasok

         $(this).next(".note-editor.note-frame").css("border", "1px solid #4e5051");
         $(this).next(".note-editor.note-frame").css("border-radius", "0px"); 
         $(this).next(".note-toolbar").css("background-color","#2d2e33");
      //   $(this).next(".note-editing-area").css({ width: "850", height: "65" });
       // $(this).next(".note-editor.note-frame").css({ width: "850", height: "65" });
         $(this).next(".note-resizebar").css("display", "none");
         $('.note-resizebar').hide();
         $('.note-editor.note-frame.note-editing-area.note-editable').css('color','white');
         $('.note-editable>p').css('color','white');
       //  $('iframe.note-video-clip').attr('width', '320').attr('height', '240');  
         });
       
          
       var styleEle = $("style#fixed");      //dropdown menu javitas  
       if (styleEle.length == 0)
         $("<style id=\"fixed\">.note-editor .dropdown-toggle::after { all: unset; } .note-editor .note-dropdown-menu { box-sizing: content-box; } .note-editor .note-modal-footer { box-sizing: content-box; }</style>")
         .prependTo("body");
       else
         styleEle.remove();
       
    
      
  });

 
 }


//-------kattinasra, a feltoltott kep eredeti meretu lesz (uj ablakaban)---------------

function openFullImage(url) {
  // Uj ablak megnyitasa a teljes keppel
  window.open(url, '_blank');
}

//-File upload - base input (summernot) ----------------------------------------------------
var uploadedImageName = '';
var uploadedImagePath = '';

function uploadImage(image) {
  // Ellenorizzuk, hogy be van-e lepve
  if (uHash == '') {
      alert('You have to login for upload an image.');
      return;
  }

  // Ellenorizzuk a fajl meretet (5 MB = 5 * 1024 * 1024 bajt)
  if (image.size > 5 * 1024 * 1024) {
      alert('The file size is too large. It can be a maximum of 5 MB.');
      return;
  }

  // Ellenorizzuk a fajl tipusat
  const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (!allowedTypes.includes(image.type)) {
      alert('Only image files (jpg, jpeg, png, gif) are allowed to be uploaded.');
      return;
  }

  
  var formData = new FormData();
  formData.append("image", image);
  
  $.ajax({
      url: 'forum/forum_file_upload.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
          var data = JSON.parse(response);
          if (data[0].error) {
              console.log(data[0].error);
          } else {
              let ms = Date.now();
            //  var imageUrl = 'http://' + data[0].url; // Store the image URL
              var imageUrl = `${data[0].protocol}://${data[0].url}`; // Store the image URL
              var image = $('<img>').attr({
                  'id': 'forum_img' + ms,
                  'src': imageUrl,
                  'style': 'max-width: 300px; max-height: 120px;',
                  'onclick': "openFullImage('" + imageUrl + "')", // Use single quotes inside the onclick
              });
              $('.summerbase').summernote("insertNode", image[0]);
              uploadedImageName = data[0].img_name; // Store the image name
              uploadedImagePath = data[0].url;
          }
      },
      error: function(data) {
          console.log(data);
      }
  });

}






//---------------------------------------------------------------------------------

 //comment panel kinyitasa  --> ide kell majd irni, a mar meglevo kommentekhez
function forum_add_comment(hozzid,rnd,level){   
     var x = document.getElementById("add01_"+hozzid+"_"+rnd);

     if (x.style.display === "none") {
        x.style.display = "block";
         updateCommentFace();
         summer_general(hozzid); //ha kinyitja a comment panelt, akkor beallitodnak a css-ek.
    
    } else {
      x.style.display = "none";
    
    }  

}

  // Comment hozzaadasa (a mar meglevo kommentekhez) 
function forum_submit_comment(hozzid,rnd){
  img_general_name = uploadImgName_general; 
  img_general_path = uploadImgPath_general; 
  var szerzo = document.getElementById("szerzo_"+rnd).value; 
  var hozzaszolas = document.getElementById("hozzaszolas_"+rnd).value;
  var szuloHozzaszolasId = document.getElementById("szuloHozzaszolasId_"+rnd).value;
 // var kepId = document.getElementById("kepid_"+rnd).value;
  var userHash = document.getElementById("userHash_"+rnd).value;
  var kepId = document.getElementById("img_ID").value;
  var msgPanel = document.getElementById("msgPanel01_"+hozzid+"_"+rnd);
  var localTime = forumFormatDate(new Date());
      
  function clear_message() {
      msgPanel.innerHTML = "";
      msgPanel.style.display = "none";      
     }  
 
     //ha van kepfeltoltes, de nincs comment, akkor a comment=image_html_general (ebben mentettuk a comment-kepet) 
     if ( (hozzaszolas =='') && (img_general_name !='') ) {hozzaszolas=image_html_general;} 
 
 $.post('/image/forum/forum_insert.php', {localTime: localTime, szerzo: szerzo, hozzaszolas: hozzaszolas, szuloHozzaszolasId: szuloHozzaszolasId, kepId: kepId, userHash: userHash, img_general_name: img_general_name, img_general_path: img_general_path}, function(data){
      
      if (hozzaszolas == '' ) {
          msgPanel.style.display = "block";
          msgPanel.innerHTML = "THE 'COMMENT FIELD' CANNOT BE EMPTY!";
          setTimeout(clear_message,3000);
          
        }
      
      if ((typeof userHash == 'undefined') || (userHash == 'guest001') ) {
          msgPanel.style.display = "block";
          msgPanel.innerHTML = "YOU HAVE TO LOGIN FOR DISCUSSION!";
          setTimeout(clear_message,3000);  
       }
       
      if ( (typeof userHash != 'undefined') && (userHash != 'guest001') && (typeof hozzaszolas != 'undefined') && (hozzaszolas != '') ) { 
          forum_updatePage(ordered);
        }
      
    
     $('#forumdata_response').html(data);
     //alert(data); 
        uploadImgName_general='';  //kitoroljuk az elozo utvonalat es nevet
        uploadImgPath_general=''; //kepfeltoltes utan
        image_html_general='';    //a comment-kepet is toroljuk

    }).fail(function() {
        alert( "Posting failed." );
            
    });

}

 //a "summer" class beallitasi (ez az alltalanos comment-panel hez tartozik) --------------------------------------------
 //  (textarea -> forum_content_load-on!) 
 function summer_general(hozzid) {
 //alert(hozzid);
  $(document).ready(function() {
    $('.summer'+hozzid).summernote({
      height: 68,
      width: 450,
      callbacks: {
        onInit: function() {
          $('.note-editable').css('background-color', '#303235');
          $('.note-editable').css('color', 'white');
        },
        onImageUpload: function(image_general, hozzid) {
            uploadImage_general(image_general[0],hozzid);
        },
      }, 
      
      toolbar: [
          ['style', ['style']],
         // ['font', ['bold', 'italic', 'underline', 'clear']],
        //  ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
        //  ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview']]
        ],
         //  fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'],
         //  fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana']
    });

          $('.summer'+hozzid).each(function() {
          $(this).next(".note-editor.note-frame").css("border", "1px solid rgb(78, 80, 81)");
         // $(this).next(".note-editor.note-frame").css({ width: "520",height: "68" });
         // $(this).next(".note-editing-area").css({ width: "520",height: "68" });
          $(this).next(".note-editor.note-frame").css("border-radius", "0");
       //   $(this).next(".textarea.note-editing-area").css({ width: "520",height: "68" });
          $(this).next(".note-resizebar").css("display", "none");
          $('.note-resizebar').hide();
          $(this).next(".note-toolbar").css({bottom: -85, position:'absolute'});
          $(this).next(".note-toolbar").css("border-bottom", "none");
          $('.note-editor.note-frame.note-editing-area.note-editable').css('color','white');
          $('.note-editable>p').css('color','white');
        //  $('.note-popover.bottom.note-image-popover').css('pointerEvents', 'none');
          //$('.note-control-selection').css('pointerEvents', 'none !important');
        
         
        });

            /*
            var styleEle = $("style#fixed");
            if (styleEle.length == 0)
            $("<style id=\"fixed\">.note-editor .dropdown-toggle::after { all: unset; } .note-editor .note-dropdown-menu { box-sizing: content-box; } .note-editor .note-modal-footer { box-sizing: content-box; }</style>")
            .prependTo("body");
            else
            styleEle.remove();
            */
 
   }); 
 } 

//--File upload - general input (summernot) --------------------------------------

var uploadImgName_general = '';
var uploadImgPath_general = '';
var image_html_general = '';

function uploadImage_general(image_general,hozzid) {
var hozz_id = document.getElementById("comment_img_upload");  //hidden mezobol hozz_id kinyerve (forum_content_load)
//var hozz_rnd = document.getElementById("comment_img_upload_rnd");  //hidden mezobol hozz_id kinyerve (forum_content_load)

 // alert(hozz_id.value);
  // Ellenorizzuk, hogy be van-e lepve
  if (uHash == '') {
      alert('You have to login for upload an image.');
      return;
  }

  // Ellenorizzuk a fajl meretet (5 MB = 5 * 1024 * 1024 bajt)
  if (image_general.size > 5 * 1024 * 1024) {
      alert('The file size is too large. It can be a maximum of 5 MB.');
      return;
  }

  // Ellenorizzuk a fajl tipusat
  const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (!allowedTypes.includes(image_general.type)) {
      alert('Only image files (jpg, jpeg, png, gif) are allowed to be uploaded.');
      return;
  }

  
  var formData = new FormData();
  formData.append("image", image_general);
  
  $.ajax({
      url: 'forum/forum_file_upload.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
          var data = JSON.parse(response);
          if (data[0].error) {
              console.log(data[0].error);
          } else {
              let ms = Date.now();
              //var image_genUrl = 'http://'+ data[0].url; // Store the image URL
              var image_genUrl = `${data[0].protocol}://${data[0].url}`; // Store the image URL
              var image_general = $('<img>').attr({
                  'id': 'forumimg_gen' + ms,
                  'src': image_genUrl,
                  'style': 'max-width: 300px; max-height: 120px;',
                  'onclick': "openFullImage('" + image_genUrl + "')", // Use single quotes inside the onclick
              });
             
              // Letrehozott kepelem HTML valtozoba mentese
              image_html_general = image_general[0].outerHTML;

              $(".summer"+hozz_id.value).summernote("insertNode", image_general[0]);
              uploadImgName_general = data[0].img_name; // Store the image name
              uploadImgPath_general = data[0].url;
               
        console.log(image_html_general); 
        }
      },
      error: function(data) {
          console.log(data);
      }
  });

}








//--------------------------------------------------------------------------------------------------------------------------

  //comment idejenek kirasa  
function forumFormatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');
    
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}
  
 //like elkuldese
function forum_submit_like(hozzid,rnd){
  var userHash = resultLogin;
    var msgPanel = document.getElementById("msgPanel01_"+hozzid+"_"+rnd);
    function clear_message() {
      msgPanel.innerHTML = "";
      msgPanel.style.display = "none";      
     }
   

    $.post('/image/forum/forumLike_insert.php', {hozzid: hozzid}, function(data){
      
        if ((typeof userHash == 'undefined') || (userHash == 'Guest') ) {
            msgPanel.style.display = "block";
            msgPanel.innerHTML = "YOU HAVE TO LOGIN FOR LIKE!";
            setTimeout(clear_message,3000); 
            }   
        
        if ((typeof userHash != 'undefined') && (userHash != 'Guest') ) { 
           forum_updatePage(ordered); 
         } 
     
   // $('#forumdata_response').html(data);
          
    }).fail(function() {
        alert( "Posting failed." );
    }); 
}

  //dislike elkuldese
  /*
function forum_submit_dislike(hozzid,rnd){
    var userHash = resultLogin;
    var msgPanel = document.getElementById("msgPanel01_"+hozzid+"_"+rnd);
    function clear_message() {
      msgPanel.innerHTML = "";
      msgPanel.style.display = "none";      
     }
 
    $.post('/image/forum/forumDisLike_insert.php', {hozzid: hozzid}, function(data){
    
        if ((typeof userHash == 'undefined') || (userHash == 'Guest') ) {
            msgPanel.style.display = "block";
            msgPanel.innerHTML = "YOU HAVE TO LOGIN FOR DISLIKE!";
            setTimeout(clear_message,3000); 
         }  
         
   
        if ((typeof userHash != 'undefined') && (userHash != 'Guest') ) { 
             forum_updatePage();
         } 
    //console.log(data);
    $('#forumdata_response').html(data);
        
    }).fail(function() {
        alert( "Posting failed." );
    });
}

*/


  //Forum beolvasasa - betoltese
function forum_updatePage(ordered) {
    //alert(ordered);
 
    if ((typeof ordered === 'undefined') || (ordered == "")) {
      if (typeof ordered !== 'undefined'){ 
        var latest_element = document.getElementById("latest_underlined");
        var oldest_element = document.getElementById("oldest_underlined");
        var best_element = document.getElementById("best_underlined");
        if (oldest_element.style.display == "block") {ordered='oldest';}  
        if (latest_element.style.display == "block") {ordered='latest';} 
        if (best_element.style.display == "block") {ordered='best';} 
      }
   
   }
    
   var kepId = '';
   if (typeof ordered !== 'undefined') {
       kepId = document.getElementById("img_ID").value;
   }
    //alert(kepId);
   var timeOffset = new Date().getTimezoneOffset()/60; 
       timeOffset *= -1;
     //  if (timeOffset < 0) { timeOffset *= -1;}
  
    $.post('/image/forum/forum_content_load.php', {kepId: kepId, timeOffset: timeOffset, ordered: ordered}, function(data){
        $('#forum_content').html(data);
      //  $('#img_page_discus').html(data); 
       console.log(data); 
    }).fail(function() {
        alert( "Posting failed." );
    });
    
    if (ordered == 'oldest'){ordered_oldest_svg();}
    if (ordered == 'latest'){ordered_latest_svg();}
    if (ordered == 'best'){ ordered_best_svg();}
    if (ordered == ''){ordered_oldest_svg();}

}

function ordered_best_svg(){
  document.getElementById("best_underlined").style.display = "block";
   document.getElementById("best_normal").style.display = "none";
   document.getElementById("oldest_normal").style.display = "block";
   document.getElementById("oldest_underlined").style.display = "none";
   document.getElementById("latest_underlined").style.display = "none";
   document.getElementById("latest_normal").style.display = "block";
}

function ordered_oldest_svg(){
  document.getElementById("oldest_normal").style.display = "none";
  document.getElementById("oldest_underlined").style.display = "block";
  document.getElementById("latest_underlined").style.display = "none";
  document.getElementById("latest_normal").style.display = "block";
  document.getElementById("best_underlined").style.display = "none";
  document.getElementById("best_normal").style.display = "block";
}

function ordered_latest_svg(){
      document.getElementById("latest_normal").style.display = "none";
   document.getElementById("latest_underlined").style.display = "block";
   document.getElementById("oldest_underlined").style.display = "none"; 
   document.getElementById("oldest_normal").style.display = "block";
   document.getElementById("best_underlined").style.display = "none";
   document.getElementById("best_normal").style.display = "block";
}




 //admin betoltese (edit panel)
function forum_loadAdmin(ordered) {

  if ( (userLevel == 1) || (userLevel == 5) ){                          //jogosultsag ellenorzes
         
         let text;
          let inpAdm = prompt("Load Admin or Setup? (a - s) ", "cancel");    //felugro ablak
          switch(inpAdm) {
            case "a":
              text = "a";
              break;
            case "s":
              text = "s";
              break;  
            case "cancel":
              text = "cancel";
              break;
          } 
     
        if (text == "a"){ 

            var ordered = ''; 
            var latest_element = document.getElementById("latest_underlined");    //megjelenites sorrendje   
            var oldest_element = document.getElementById("oldest_underlined");
            var best_element = document.getElementById("best_underlined");
            if (oldest_element.style.display == "block") {ordered='oldest';}  
            if (latest_element.style.display == "block") {ordered='latest';} 
            if (best_element.style.display == "block") {ordered='best';} 
          
            var kepId = document.getElementById("img_ID").value;
            var timeOffset = new Date().getTimezoneOffset()/60; 
                timeOffset *= -1;
            
                
            $.post('/image/forum/forum_admin_load.php', {kepId: kepId, timeOffset: timeOffset, ordered: ordered}, function(data){
                $('#forum_content').html(data);
                  
            }).fail(function() {
                alert( "Posting failed." );
            });
      
      }  

        if (text == "s"){ 
          $.ajax({   
            url: '/image/forum/setup_forum.php', 
            success: function(data_res) {
            $('#forum_content').html(data_res);
            
            }
          });
        
        }

  }

}


  //sorrendezes betoltese - kiirasa ->OLDEST
function forum_order_oldest(){
   
   var ordered = 'oldest';
   
   var kepId = document.getElementById("img_ID").value;
   var timeOffset = new Date().getTimezoneOffset()/60; 
       timeOffset *= -1;
     //  if (timeOffset < 0) { timeOffset *= -1;}
        
    $.post('/image/forum/forum_content_load.php', {kepId: kepId, ordered: ordered, timeOffset: timeOffset}, function(data){
        $('#forum_content').html(data);
      //  $('#img_page_discus').html(data); 
        
    }).fail(function() {
        alert( "Posting failed." );
    });
        
   document.getElementById("oldest_normal").style.display = "none";
   document.getElementById("oldest_underlined").style.display = "block";
   document.getElementById("latest_underlined").style.display = "none";
   document.getElementById("latest_normal").style.display = "block";
   document.getElementById("best_underlined").style.display = "none";
   document.getElementById("best_normal").style.display = "block";
}
   //sorrendezes betoltese - kiirasa ->LATEST
function forum_order_latest(){ 
 
   var ordered = 'latest';
   
   var kepId = document.getElementById("img_ID").value;
   var timeOffset = new Date().getTimezoneOffset()/60; 
       timeOffset *= -1;
     //  if (timeOffset < 0) { timeOffset *= -1;}
        
    $.post('/image/forum/forum_content_load.php', {kepId: kepId, ordered: ordered, timeOffset: timeOffset}, function(data){
        $('#forum_content').html(data);
      //  $('#img_page_discus').html(data); 
        
    }).fail(function() {
        alert( "Posting failed." );
    });
  
  
   document.getElementById("latest_normal").style.display = "none";
   document.getElementById("latest_underlined").style.display = "block";
   document.getElementById("oldest_underlined").style.display = "none"; 
   document.getElementById("oldest_normal").style.display = "block";
   document.getElementById("best_underlined").style.display = "none";
   document.getElementById("best_normal").style.display = "block";

}
   //sorrendezes betoltese - kiirasa ->BEST - likok
function forum_order_best(){
   
   var ordered = 'best';
   
   var kepId = document.getElementById("img_ID").value;
   var timeOffset = new Date().getTimezoneOffset()/60; 
       timeOffset *= -1;
     //  if (timeOffset < 0) { timeOffset *= -1;}
        
    $.post('/image/forum/forum_content_load.php', {kepId: kepId, ordered: ordered, timeOffset: timeOffset}, function(data){
        $('#forum_content').html(data);
      //  $('#img_page_discus').html(data); 
        
    }).fail(function() {
        alert( "Posting failed." );
    });
      
   document.getElementById("best_underlined").style.display = "block";
   document.getElementById("best_normal").style.display = "none";
   document.getElementById("oldest_normal").style.display = "block";
   document.getElementById("oldest_underlined").style.display = "none";
   document.getElementById("latest_underlined").style.display = "none";
   document.getElementById("latest_normal").style.display = "block";
}


  //main input panel - ha belekattint a user, megjelennek a dolgok
$(document).ready(function(){  


  /*jav0808 - alapbol megjelennek, nem kell belekattintani -------------*/
 // document.getElementById("img002").src = "img_user/"+user_img_path;    
 // $('#btn002').show();
 // $('#szerzo_002').css('visibility','visible');
 // $('#img002').css('visibility','visible');
 /*------------------------------------------------------------------*/

   $('#before_img_input002').click(function(){
     // document.getElementById("szerzo_002").value = resultLogin; 
     
     // document.getElementById("img002").src = "img_user/"+user_img_path;
     // $('#btn002').show();
     // $('#szerzo_002').css('visibility','visible');
     // $('#img002').css('visibility','visible');
     
      var svgPlus = document.getElementById("discuss_plus");
      var svgMinus = document.getElementById("discuss_minus");
      document.getElementById("forum_content").style.opacity = "1";
      document.getElementById("forum_content").style.overflow = 'auto';
     // msgPanel004.style.display = "block";   
     // forum_commentNumber();                               //commentek szamanak kiirasa
     // svgMinus.style.display = "block";
     // svgPlus.style.display = "none";
      
   });


  });

 // a kommentek szama - es kiirasa  
function forum_commentNumber() {
  var kepId = document.getElementById("img_ID").value;
    $.ajax({
      type : "post",
      url:'forum/forum_comment_number.php',
    data: {
      kepId: kepId,
   
    }, // pass data 
    success:function(result) { 
    document.getElementById("svg_6").innerHTML = result;
  // console.log(result);
    }
   });
}


  // commentek szerkesztese (admin-panel-fooldal)
function forum_edit_comment(comm_id){
 
  forumPanel = document.getElementById("forum_content");
  var confirmText = "Are you sure you want to update?";
  var kepId = document.getElementById("img_ID").value;
  if(confirm(confirmText)) {



         var update_comment = document.getElementById("edit_" + comm_id).value;
         var timeOffset = new Date().getTimezoneOffset()/60; 
             timeOffset *= -1;
                     
           $.post('/image/forum/forum_update_comment.php', {kepId: kepId, update_comment: update_comment ,comm_id:comm_id}, function(data){
              $('#forum_content').html(data);
             
              forumPanel.style.display = "block";
            //  setTimeout(forum_updatePage,2000); 
              setTimeout(function() {forum_updatePage(ordered);}, 2000);

          }).fail(function() {
              alert( "Posting failed." );
          });
   }

  return false;

}   


   
  // kommentek torlese (admin-panel-fooldal)
function forum_delete_comment(comm_id){
  forumPanel = document.getElementById("forum_content");
  var confirmText = "Are you sure you want to delete?";
  if(confirm(confirmText)) {

         var kepId = document.getElementById("img_ID").value;    
         var timeOffset = new Date().getTimezoneOffset()/60; 
             timeOffset *= -1;
                        
           $.post('/image/forum/forum_delete_comment.php', {kepId: kepId, comm_id:comm_id}, function(data){
            $('#forum_content').html(data);
            //console.log(data); 

            forumPanel.style.display = "block";
           // setTimeout(forum_updatePage,2000);
           setTimeout(function() {forum_updatePage(ordered);}, 2000);
           forum_commentNumber();  
                         
          }).fail(function() {
              alert( "Posting failed." );
          });
   }

  return false;

}   

//addEdit Panel megjelenik 
function forum_add_edit(comm_id)
{
  var userHash_commented = document.getElementById("userHashCommented_"+comm_id).value;  //a user amelyik megirta a commentet
  if (userHash_commented == uHash) {                                            //ha nem egyezik a belepett userrel -> nem csinal semmit 
      var addEditPanel = document.getElementById("addEditPanel_"+comm_id);
      
      if (addEditPanel.style.display === "none") {
          addEditPanel.style.display = "block";
          summer_general(comm_id); //ha kinyitja a panelt, akkor beallitodnak a css-ek (summernot).

          }  else {
          addEditPanel.style.display = "none";
        
        } 
  }
    
   
}


// edit comment --> user itt szerkesztheti a sajat coommentjet 
function forum_addEdit_submit(comm_id)
{ 
  var confirmText = "Are you sure you want to update?";
  if(confirm(confirmText)) {

    var userHash_commented = document.getElementById("userHashCommented_"+comm_id).value;
    var addEdit_comment = document.getElementById("add_edit_" + comm_id).value;
    var localTime = forumFormatDate(new Date());
                        
    $.post('/image/forum/forum_add_edit.php', {comm_id: comm_id, addEdit_comment: addEdit_comment, userHash_commented: userHash_commented, localTime: localTime}, function(data){
      $('#forum_content').html(data);

      //setTimeout(forum_updatePage,2000);
      setTimeout(function() {forum_updatePage(ordered);}, 2000);                   
          }).fail(function() {
              alert( "Posting failed." );
          });
   }

  return false;

}



// DELETE comment --> user itt torolheti a sajat coommentjet 
function forum_addEdit_delete(comm_id)
{ 
  var confirmText = "Are you sure you want to delete?";
  if(confirm(confirmText)) {

    var userHash_commented = document.getElementById("userHashCommented_"+comm_id).value;
    var addEdit_comment = document.getElementById("add_edit_" + comm_id).value;
    var localTime = forumFormatDate(new Date());
                        
    $.post('/image/forum/forum_add_delete.php', {comm_id: comm_id, addEdit_comment: addEdit_comment, userHash_commented: userHash_commented, localTime: localTime}, function(data){
      $('#forum_content').html(data);
      console.log(data); 
      //setTimeout(forum_updatePage,2300);
      setTimeout(function() {forum_updatePage(ordered);}, 2000);
      forum_commentNumber();                     
          }).fail(function() {
              alert( "Posting failed." );
          });
   }

  return false;

}



function forum_report_comment(comId)
{
//alert(comId);
var comment_uhash = document.getElementById("userHashCommented_"+comId);  

if (uHash) {
  document.querySelector('#report_user input[name="reporter_hash"]').value = uHash;
  document.getElementById('forum_report_user_'+comId).submit(); // Az egyedi azonosítóval rendelkező form elküldése
 } else {
  alert('Please log in to access the report.');
 }

}


function refresh_comments(){
  forum_commentNumber();  
  forum_updatePage();

  document.getElementById("msgPanel005").style.display = "none";
}

function close_newcomment_button(){
  document.getElementById("msgPanel005").style.display = "none";
 
}


function user_profil(comm_id){
 var comment_hash = document.getElementById('comm_uhas'+comm_id);
 var user_comment_hash = comment_hash.value;
 window.open('index.php?modul=creator_page&userhash=' + user_comment_hash, '_blank'); 

}



//chat-------------------------------------------------------------------------------------------

//--------------------------------------------------------

