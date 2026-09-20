 
<?php
$imgSrc = $_GET['imgSrc'];
?>
<html lang="en">
  <head>
    <title>ImagePage - Minty Cooperative Capybara</title>
    <meta
      property="og:title"
      content="ImagePage - Minty Cooperative Capybara"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    
 
    
      
    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;} input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth;  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
      /*  color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);*/
      

      }
      #kep {
    width: 435px;
    max-height: 579px;
    object-fit: contain; 
	margin: auto;
}
.imageprompts1 {
  color: white; 
  overflow-y: auto; 
  height: 364px;
  font-size: 0.85rem;
}
.imageprompts {
  color: white; 
  font-size: 0.85rem;
}
.btn-secondary {
    color: #fff;
    background-color: #2d2e33 !important;
    border-color: #6c757d;
  }
  .hidden {
    display: none;
}
 #mycanvas {
  position: absolute;
 top: -27px;
 left: -34px;

}
    
/*-----------SUMMERNOTE-toolbar--------------------------*/
/* SUMMERNOT CSS--------------*/

/*
#summernote {
    margin-top: 10px; 
}
*/
.card-block{
  height:100px;
  /*display:none;*/
}

 /* 
 .note-editing-area{
    height:70px; 
     width:650px; 
  }  */


.note-resizebar{
 display:none;
}
        
.card {
    --bs-card-bg: #2d2e33;
     color: #e7e7e7;
      border-color: white;/*#25262b;*/  
   }
.note-btn-group .note-btn {
    border-color: #00000032;
    font-size: 11px;
    padding: 0.28rem 0.65rem;
}
.note-toolbar {  
  background-color: #2d2e33; 
  position: absolute;  
  bottom: -40px;  /*at will*/
  border-bottom: none;  /*at will*/
  /* ... something else here ... */
}   

    
/*
.note-editor .note-frame .card{
 border-color: white !important;//#25262b; 
 width: 850px;
}  
  */

 .note-editor .dropdown-toggle::after { all: unset } .note-editor .note-dropdown-menu { box-sizing: content-box } .note-editor .note-modal-footer { box-sizing: content-box }

.note-editable > p {
  color: white;

} 

.note-editable {
   text-transform: none;
   letter-spacing: normal;
   line-height: 1.15;
}


/*
//dropdown menu -> sotet hatter
.note-dropdown-menu.note-check.dropdown-fontname{
  background-color: #2d2e33;   
 }

.note-dropdown-menu.dropdown-style{
background-color: #2d2e33 !important;   
}

.note-dropdown-menu{
 background-color: #2d2e33 !important;   
}
*/

iframe.note-video-clip {
    width: 320px; 
    height:240px;  
}



/*------------Summernote:end---------------------*/  

  

    
    </style>
    
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style.css" />
    
  </head>
  <body>



    <div>        
      <link href="./image-page.css" rel="stylesheet" />
      <div class="modal-close-button" style="position: absolute; top: 30px; left: 30px; z-index: 1050;">
        <button type="button22" class="btn22 btn-secondary" data-bs-dismiss="modal" id=btn_img_back01>          
          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l5.147 5.146a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
          </svg>
        </button>
      </div>
      <div class="image-page-container">
          
      
      
      <div class="image-page-cont-background" id="img_page_cont_bg">
          <div class="image-page-img-gal"><?php echo '<img id="kep" src="' . $imgSrc . '">' ?>
            <span class="image-page-model-sample-img">
              <span>Model Sample Images</span>
              <br />
              <br />
            </span>
			<!--  info gomb kivetele
            <svg viewBox="0 0 1024 1024" class="image-page-icon">
              <path
                d="M448 304c0-26.4 21.6-48 48-48h32c26.4 0 48 21.6 48 48v32c0 26.4-21.6 48-48 48h-32c-26.4 0-48-21.6-48-48v-32z"
              ></path>
              <path d="M640 768h-256v-64h64v-192h-64v-64h192v256h64z"></path>
              <path
                d="M512 0c-282.77 0-512 229.23-512 512s229.23 512 512 512 512-229.23 512-512-229.23-512-512-512zM512 928c-229.75 0-416-186.25-416-416s186.25-416 416-416 416 186.25 416 416-186.25 416-416 416z"
              ></path></svg>
			  -->
			  
			  <svg viewBox="0 0 1024 1024" class="image-page-like">
              <path
                d="M755.188 64c-107.63 0-200.258 87.554-243.164 179-42.938-91.444-135.578-179-243.216-179-148.382 0-268.808 120.44-268.808 268.832 0 301.846 304.5 380.994 512.022 679.418 196.154-296.576 511.978-387.206 511.978-679.418 0-148.392-120.43-268.832-268.812-268.832z"
              ></path></svg>
			  
			  <!--
			  <svg viewBox="0 0 1024 1024" class="image-page-report">
              <path
                d="M554 554v-256h-84v256h84zM512 738q22 0 39-17t17-39-17-38-39-16-39 16-17 38 17 39 39 17zM672 128l224 224v320l-224 224h-320l-224-224v-320l224-224h320z"
              ></path>
            </svg>
			-->
			
			<svg viewBox="0 0 1024 1024" class="image-page-report" id="svgSubmit3">
              <path
                d="M512 128c-211.755 0-384 172.288-384 384s172.245 384 384 384 384-172.288 384-384-172.245-384-384-384zM512 810.667c-164.651 0-298.667-133.973-298.667-298.667s134.016-298.667 298.667-298.667 298.667 133.973 298.667 298.667-134.016 298.667-298.667 298.667z"
              ></path>
              <path
                d="M542.165 512l112.896-112.896c8.277-8.277 8.277-21.845 0-30.165-8.32-8.277-21.888-8.277-30.165 0l-112.896 112.896-112.896-112.939c-8.32-8.277-21.888-8.277-30.165 0-8.32 8.32-8.32 21.888 0 30.165l112.896 112.939-112.896 112.896c-8.32 8.32-8.32 21.888 0 30.165 4.139 4.181 9.6 6.272 15.061 6.272s10.923-2.091 15.104-6.229l112.896-112.939 112.896 112.896c4.181 4.181 9.643 6.272 15.104 6.272s10.923-2.091 15.104-6.229c8.277-8.277 8.277-21.845 0-30.165l-112.939-112.939z"
              ></path>
            </svg>
            <form action="index.php?modul=report_form_image" method="POST" id="report_image" target="_blank">
  <input type="hidden" name="reported_image" value="value1">
  <input type="hidden" name="reported_model_name" value="value2">
  <input type="hidden" name="reported_u_image" value="value1">
  <input type="hidden" name="reported_u_name" value="value2">
  <input type="hidden" name="reporter_hash" value="value2">
  <input type="hidden" name="reported_hash" value="value2">
  
  <!-- További input mezők szükség szerint -->
  <button type="submit" class="hidden">Küldés</button>
            </form>
			
          </div>
          <div class="image-page-propt">
            <span class="image-page-prompt">
              <span>Prompt</span>
              <br />
            </span>
           <div class="imageprompts1" id="prompt"></div>
            <svg viewBox="0 0 1024 1024" class="image-page-copy-prompt">
              <path
                d="M810 896v-598h-468v598h468zM810 214q34 0 60 25t26 59v598q0 34-26 60t-60 26h-468q-34 0-60-26t-26-60v-598q0-34 26-59t60-25h468zM682 42v86h-512v598h-84v-598q0-34 25-60t59-26h512z"
              ></path>
            </svg>
          </div>
          <div class="image-page-neg-propt">
            <span class="image-page-neg-prompt">
              <span>Negative Prompt</span>
              <br />
            </span>
            <div class="imageprompts1" id="negprompt"></div>
            <svg viewBox="0 0 1024 1024" class="image-page-copy-prompt1">
              <path
                d="M810 896v-598h-468v598h468zM810 214q34 0 60 25t26 59v598q0 34-26 60t-60 26h-468q-34 0-60-26t-26-60v-598q0-34 26-59t60-25h468zM682 42v86h-512v598h-84v-598q0-34 25-60t59-26h512z"
              ></path>
            </svg>
          </div>
          <div class="image-page-sampling-m">
            <span class="image-page-sampling-s">
              <span>Sampling Method</span>
              <br />
            </span>
            <div class="imageprompts" id="samlingmethod"></div>
          </div>
          <div class="image-page-checkpoint">
            <span class="image-page-checkpoint1">
              <span>Checkpoint</span>
              <br />
            </span>
            <div class="imageprompts" id="checkpoint"></div>
          </div>
          <div class="image-page-cfg">
            <span class="image-page-cfg1">
              <span>CFG Scale</span>
              <br />
              <br />
            </span>
            <div class="imageprompts" id="CGFscale"></div>
          </div>
          <div class="image-page-steps">
            <span class="image-page-steps1">
              <span>Steps</span>
              <br />
              <br />
            </span>
            <div class="imageprompts" id="steps"></div>
          </div>
          <div class="image-page-seed">
            <span class="image-page-seed1">
              <span>Seed</span>
              <br />
              <br />
            </span>
            <div class="imageprompts" id="seed"></div>
           
          </div>
          <div class="image-page-generator" id="generator"><span>Workflow</span></div>
          <div class="image-page-clip-skip">
            <span class="image-page-clip-skip1">
              <span>Clip Skip</span>
              <br />
              <br />
            </span>
            <div class="imageprompts" id="clipskip"></div>        
          </div>

 <!-- FORUM: start  -->
                                  
          <div id="img_page_discus" class="image-page-discussion">
        
                          
            <span class="image-page-discussion1">
              <span>Discussion</span>     
              
              <div id="writeOut_commNumb" class="image-page-add-comment" style="margin-left:320px;margin-top:17px;">
<span>              
<svg width="83" height="37" xmlns="http://www.w3.org/2000/svg" stroke="null" style="vector-effect: non-scaling-stroke;" version="1.1" xml:space="preserve">
 <g stroke="null">
  <title stroke="null">Layer 1</title>
  <g stroke="null" id="svg_1">
   <path stroke="null" id="svg_478" d="m2.78053,5.64404l0,0c0,-2.18012 3.8365,-3.94747 8.56904,-3.94747l3.89501,0l0,0l18.69608,0l35.05512,0c2.27265,0 4.45221,0.4159 6.05922,1.15618c1.60699,0.7403 2.50981,1.74434 2.50981,2.79129l0,9.86866l0,0l0,5.92119l0,0c0,2.18012 -3.83647,3.94747 -8.56904,3.94747l-35.05512,0l-24.42411,10.03749l5.72803,-10.03749l-3.89501,0c-4.73254,0 -8.56904,-1.76733 -8.56904,-3.94747l0,0l0,-5.92119l0,0l0,-9.86866z" fill="#2d2e33"/>
   <path stroke="null" id="svg_678" d="m-19.04852,-56.91246l0,0c0,-2.43662 6.42869,-4.41188 14.35892,-4.41188l6.52679,0l0,0l31.32854,0l58.74096,0c3.80822,0 7.46046,0.46482 10.1533,1.29221c2.69281,0.82739 4.20562,1.94957 4.20562,3.11967l0,11.02969l0,0l0,6.61781l0,0c0,2.43662 -6.42869,4.41188 -14.35892,4.41188l-58.74096,0l-40.92685,11.21837l9.59834,-11.21837l-6.52679,0c-7.9302,0 -14.35892,-1.97526 -14.35892,-4.41188l0,0l0,-6.61781l0,0l0,-11.02969l-0.00002,0z" fill="#999999"/>
   <path stroke="#b2b2b2" id="svg_978" d="m2.28535,5.32505l0,0c0,-2.22977 3.85738,-4.03735 8.61571,-4.03735l3.91624,0l0,0l18.79793,0l35.24608,0c2.28504,0 4.47647,0.42535 6.09224,1.18251c1.61575,0.75716 2.52349,1.78407 2.52349,2.85484l0,10.09338l0,0l0,6.05603l0,0c0,2.22977 -3.85738,4.03735 -8.61571,4.03735l-35.24608,0l-24.55715,10.26605l5.75925,-10.26605l-3.91624,0c-4.75833,0 -8.61571,-1.80758 -8.61571,-4.03735l0,0l0,-6.05603l0,0l0,-10.09338l-0.00002,0l-0.00002,0z" fill="none"/>
  </g>
  <text stroke="#b2b2b2" xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="14" stroke-width="0" id="svg_7788" y="17" x="14.18604" fill="#000000"/>
  <text stroke="#b2b2b2" transform="matrix(1.16563 0 0 0.97292 19.2339 9.91394)" xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="12" stroke-width="0" id="svg_1178" y="8.04596" x="-7.67017" fill="gray">44</text>
  <text stroke="#b2b2b2" transform="matrix(0.779707 0 0 0.704046 20.693 5.0824)" xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="12" id="svg_278" y="16.41288" x="11.13579" stroke-width="0" fill="gray">comments</text>
 </g>

</svg>   
</span>
      
             </div> 
            
              <br />
            </span>     
<svg viewBox="0 0 1024 1024" onclick="forum_discuss_show()" class="image-page-add-comment" id="discuss_plus">
  <path d="M768 426.667h-170.667v-170.667c0-47.104-38.229-85.333-85.333-85.333s-85.333 38.229-85.333 85.333l3.029 170.667h-173.696c-47.104 0-85.333 38.229-85.333 85.333s38.229 85.333 85.333 85.333l173.696-3.029-3.029 173.696c0 47.104 38.229 85.333 85.333 85.333s85.333-38.229 85.333-85.333v-173.696l170.667 3.029c47.104 0 85.333-38.229 85.333-85.333s-38.229-85.333-85.333-85.333z"
   ></path>
</svg> 
<svg viewBox="0 0 1024 1024" onclick="forum_discuss_hide()" class="image-page-add-comment" style="display:none;"  id="discuss_minus">
  <path d="M768 426.667h-512v170.667h1024v-170.667h-512z" ></path>
</svg>          
          
           
            <!-- main input  -->
            
  <div class="forum_firstPanel" id="forum_input01">    
       
    <table>
        <tr>
            <td><img src="/image/forum/forum_face_img.jpg" id="img002" class="commentface" alt="face" width="33" height="33"></td>
            <td><input type="text" id="szerzo_img_002" name="szerzo1" class="forum_commentWriter" value="Guest" readonly></td>
       
          </tr>
     </table> 
     
      <!--  summernot plugin - inicializalas: forum.js (summer_base)  -->       
    <textarea id="before_img_input002" class="forum_commentInput summerbase" name="base_comment" placeholder="Write Here..." rows="4" cols="30"></textarea>      
    <br>  
                  
                             
    <button id="btn002" onclick="forum_base_submit()" class="forum_commentButton">COMMENT SUBMIT</button>
  
  </div>

 
           <!-- end: main input  -->
       

     <div id="msgPanel005" class="panel_comment forum_msgPpanel_hide" style="display:none;border-color:orange;"> 
             <div style="font-size: 15px;">NEW COMMENT!</span></div>       
              <div class="buttons_comment">
              <button onclick="refresh_comments()" class="button_comment">Refresh</button>
           <!--<p>&#10227;</p>   -->  
             <button onclick="close_newcomment_button()" class="button_comment">Close</button> 
        </div> 
      </div>
     
     
     <div id="msgPanel003" class="forum_msgPpanel_hide">
     </div>
         
     
     <div id="msgPanel004" class="forum_msgInfo">
              <span style="float:left";>
              <svg width="160" height="20" xmlns="http://www.w3.org/2000/svg">
              <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="12" id="svg_6" y="14.13326" x="6.33466" stroke-width="0" stroke="#000" fill="#fc7d48">Number of comments: </text>
              </svg> 
              
              </span>
             
              <span onclick="forum_loadAdmin()" style="margin-right:80px;">
                <svg width="115" height="30" xmlns="http://www.w3.org/2000/svg">
                  <g id="Layer_1">
                   <title>The comments so far</title>
                   <path stroke="#000" id="svg_1" d="m17.90999,-2.68701l16,0l0,0l24,0l56,0l0,12.91823l0,0l0,5.53638l0,3.69092l-56,0l-39.84461,10.85447l15.84462,-10.85447l-16,0l0,-3.69092l0,-5.53638l0,0l0,-12.91823z" fill="#fc7d48"/>
                   <text transform="matrix(0.776854 0 0 0.616447 19.6637 -1.11124)" stroke="#000" xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="24" stroke-width="0" id="svg_61" y="23.39999" x="7.99999" fill="#efe6e6">Comments</text>
                  </g>
              </svg>
                
              </span>
                                  
              <span id="oldest_comments" onclick="forum_order_oldest()" style="float:right; cursor: pointer;">
                  <svg id="oldest_normal" width="65" height="25" xmlns="http://www.w3.org/2000/svg">
                    <path id="svg_13" d="m337.79502,16.40341l0.76393,0l0.23606,-0.54067l0.23606,0.54067l0.76393,0l-0.61803,0.33415l0.23607,0.54067l-0.61803,-0.33416l-0.61803,0.33416l0.23607,-0.54067l-0.61803,-0.33415z" stroke-width="0" stroke="#000" fill="#efe6e6"/>
                    <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="15" id="svg_12" y="14.63333" x="13.83333" stroke-width="0" stroke="#000" fill="#fc7d48">Oldest</text>
                  </svg>
             
                  <svg id="oldest_underlined" style="display:none;" width="65" height="25" xmlns="http://www.w3.org/2000/svg">
                    <path id="svg_15" d="m337.79502,16.40341l0.76393,0l0.23606,-0.54067l0.23606,0.54067l0.76393,0l-0.61803,0.33415l0.23607,0.54067l-0.61803,-0.33416l-0.61803,0.33416l0.23607,-0.54067l-0.61803,-0.33415z" stroke-width="0" stroke="#000" fill="#efe6e6"/>
                    <line stroke="#fc7d48" id="svg_7" y2="19.63333" x2="53.33333" y1="19.96666" x1="14.66667" fill="none"/>
                    <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="15" id="svg_12" y="14.63333" x="13.83333" stroke-width="0" stroke="#000" fill="#fc7d48">Oldest</text>
                  </svg>
                               
             </span>
             

             <span id="latest_comments" onclick="forum_order_latest()" style="float:right; cursor: pointer;">

             <svg id="latest_underlined" width="65" height="25" xmlns="http://www.w3.org/2000/svg">
                <path id="svg_12" d="m337.79502,16.40341l0.76393,0l0.23606,-0.54067l0.23606,0.54067l0.76393,0l-0.61803,0.33415l0.23607,0.54067l-0.61803,-0.33416l-0.61803,0.33416l0.23607,-0.54067l-0.61803,-0.33415z" stroke-width="0" stroke="#000" fill="#efe6e6"/>
                <line stroke="#fc7d48" id="svg_7" y2="19.63333" x2="53.33333" y1="19.96666" x1="14.66667" fill="none"/>
                <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="15" id="svg_10" y="14.3" x="14.83333" stroke-width="0" stroke="#000" fill="#fc7d48">Latest</text>
                </svg>
                <svg id="latest_normal" style="display:none;" width="65" height="25" xmlns="http://www.w3.org/2000/svg">
                <path id="svg_14" d="m337.79502,16.40341l0.76393,0l0.23606,-0.54067l0.23606,0.54067l0.76393,0l-0.61803,0.33415l0.23607,0.54067l-0.61803,-0.33416l-0.61803,0.33416l0.23607,-0.54067l-0.61803,-0.33415z" stroke-width="0" stroke="#000" fill="#efe6e6"/>
                <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="15" id="svg_14" y="14.3" x="13.83333" stroke-width="0" stroke="#000" fill="#fc7d48">Latest</text>
                </svg>
             </span>
              

              <span onclick="forum_order_best()" style="float: right;cursor: pointer;">
           
              <svg id="best_underlined" style="display:none;" width="65" height="25" xmlns="http://www.w3.org/2000/svg">
                <path id="svg_1135" d="m337.79502,16.40341l0.76393,0l0.23606,-0.54067l0.23606,0.54067l0.76393,0l-0.61803,0.33415l0.23607,0.54067l-0.61803,-0.33416l-0.61803,0.33416l0.23607,-0.54067l-0.61803,-0.33415z" stroke-width="0" stroke="#000" fill="#efe6e6"/>
                <line stroke="#fc7d48" id="svg_23" y2="18.63333" x2="42.16666" y1="18.63333" x1="15.16666" fill="none"/>
                <line id="svg_24" y2="42.96666" x2="61.16666" y1="42.96666" x1="61.5" stroke="#000" fill="none"/>
                <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="15" id="svg_26" y="14.96666" x="14.83333" stroke-width="0" stroke="#000" fill="#fc7d48">Best</text>
                </svg>


              
                <svg id="best_normal" width="65" height="25" xmlns="http://www.w3.org/2000/svg">
                 <path id="svg_2451" d="m337.79502,16.40341l0.76393,0l0.23606,-0.54067l0.23606,0.54067l0.76393,0l-0.61803,0.33415l0.23607,0.54067l-0.61803,-0.33416l-0.61803,0.33416l0.23607,-0.54067l-0.61803,-0.33415z" stroke-width="0" stroke="#000" fill="#efe6e6"/>
                  <line id="svg_24" y2="42.96666" x2="61.16666" y1="42.96666" x1="61.5" stroke="#000" fill="none"/>
                  <text xml:space="preserve" text-anchor="start" font-family="Noto Sans JP" font-size="15" id="svg_26" y="14.96666" x="14.83333" stroke-width="0" stroke="#000" fill="#fc7d48">Best</text>
                </svg>
              
              </span>
     
       </div> 
       
         <div id="forum_content" class="forum-content forum_scroll summernote"> 
                        <!--forum tartalma - ide jonnek a commentek -->
             </div>   
   </div>   
   
   <!-- FORUM: End --> 
		  
		  <!-- Custom Gallery + textbox alatta kivetele
          <div class="image-page-custom-gallery">
            <span class="image-page-custom-gallery1">Custom Gallery</span>
            <svg viewBox="0 0 1024 1024" class="image-page-add-gallery">
              <path
                d="M768 426.667h-170.667v-170.667c0-47.104-38.229-85.333-85.333-85.333s-85.333 38.229-85.333 85.333l3.029 170.667h-173.696c-47.104 0-85.333 38.229-85.333 85.333s38.229 85.333 85.333 85.333l173.696-3.029-3.029 173.696c0 47.104 38.229 85.333 85.333 85.333s85.333-38.229 85.333-85.333v-173.696l170.667 3.029c47.104 0 85.333-38.229 85.333-85.333s-38.229-85.333-85.333-85.333z"
              ></path>
            </svg>
          </div>
		  -->
		    
          <div class="image-page-stats">
            <div class="image-page-stat">
              <h1 class="image-page-text25">
                <span>50</span>
                <span>+</span>
              </h1>
              <svg viewBox="0 0 1024 1024" class="image-page-icon10">
                <path
                  d="M755.188 64c-107.63 0-200.258 87.554-243.164 179-42.938-91.444-135.578-179-243.216-179-148.382 0-268.808 120.44-268.808 268.832 0 301.846 304.5 380.994 512.022 679.418 196.154-296.576 511.978-387.206 511.978-679.418 0-148.392-120.43-268.832-268.812-268.832z"
                ></path>
              </svg>
            </div>
            <div class="image-page-stat1">
              <h1 class="image-page-text28"><span>0</span></h1>
              <svg viewBox="0 0 1024 1024" class="image-page-icon12">
                <path
                  d="M402.286 219.429c-178.286 0-329.143 100.571-329.143 219.429 0 62.857 42.286 123.429 115.429 165.714l55.429 32-20 48c12-6.857 24-14.286 35.429-22.286l25.143-17.714 30.286 5.714c28.571 5.143 57.714 8 87.429 8 178.286 0 329.143-100.571 329.143-219.429s-150.857-219.429-329.143-219.429zM402.286 146.286c222.286 0 402.286 130.857 402.286 292.571s-180 292.571-402.286 292.571c-34.857 0-68.571-3.429-100.571-9.143-47.429 33.714-101.143 58.286-158.857 73.143-15.429 4-32 6.857-49.143 9.143h-1.714c-8.571 0-16.571-6.857-18.286-16.571v0c-2.286-10.857 5.143-17.714 11.429-25.143 22.286-25.143 47.429-47.429 66.857-94.857-92.571-53.714-152-136.571-152-229.143 0-161.714 180-292.571 402.286-292.571zM872 814.286c19.429 47.429 44.571 69.714 66.857 94.857 6.286 7.429 13.714 14.286 11.429 25.143v0c-2.286 10.286-10.857 17.714-20 16.571-17.143-2.286-33.714-5.143-49.143-9.143-57.714-14.857-111.429-39.429-158.857-73.143-32 5.714-65.714 9.143-100.571 9.143-103.429 0-198.286-28.571-269.714-75.429 16.571 1.143 33.714 2.286 50.286 2.286 122.857 0 238.857-35.429 327.429-99.429 95.429-69.714 148-164 148-266.286 0-29.714-4.571-58.857-13.143-86.857 96.571 53.143 159.429 137.714 159.429 233.143 0 93.143-59.429 175.429-152 229.143z"
                ></path>
              </svg>
            </div>
            <div class="image-page-stat2">
              <h1 class="image-page-text30">
                <span>500</span>
                <span>+</span>
              </h1>
              <svg viewBox="0 0 1024 1024" class="image-page-icon14">
                <path
                  d="M214 768h596v86h-596v-86zM810 384l-298 298-298-298h170v-256h256v256h170z"
                ></path>
              </svg>
            </div>
          </div>
          <span class="image-page-image-name">
            <span>Image Name</span>
            <br />
            <br />
          </span>
          <span class="image-page-upload-date">
            <span>Uploaded : 24.01.2023</span>
            <br />
            <br />
          </span>
          <div class="image-page-social-bar">
            <svg
              viewBox="0 0 950.8571428571428 1024"
              class="image-page-twitter"
            >
              <path
                d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"
              ></path></svg><svg viewBox="0 0 877.7142857142857 1024" class="image-page-insta">
              <path
                d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"
              ></path></svg><svg
              viewBox="0 0 602.2582857142856 1024"
              class="image-page-face-b"
            >
              <path
                d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"
              ></path></svg><svg viewBox="0 0 1024 1024" class="image-page-icon19">
              <path
                d="M1024 483.429c0 44.571-25.143 82.857-62.286 101.714 4.571 17.714 6.857 36 6.857 54.857 0 180.571-204 326.857-455.429 326.857-250.857 0-454.857-146.286-454.857-326.857 0-18.286 2.286-36.571 6.286-53.714-38.286-18.857-64.571-57.714-64.571-102.857 0-62.857 50.857-113.714 113.714-113.714 32.571 0 61.714 13.714 82.857 36 77.143-53.714 180-88.571 294.286-92.571l66.286-297.714c2.286-10.286 13.143-17.143 23.429-14.857l210.857 46.286c13.714-27.429 42.857-46.857 76-46.857 47.429 0 85.714 38.286 85.714 85.143 0 47.429-38.286 85.714-85.714 85.714-46.857 0-85.143-38.286-85.143-85.143l-190.857-42.286-59.429 269.714c114.857 3.429 218.857 37.714 296.571 91.429 20.571-21.714 49.714-34.857 81.714-34.857 62.857 0 113.714 50.857 113.714 113.714zM238.857 597.143c0 47.429 38.286 85.714 85.143 85.714 47.429 0 85.714-38.286 85.714-85.714 0-46.857-38.286-85.143-85.714-85.143-46.857 0-85.143 38.286-85.143 85.143zM701.714 800c8.571-8.571 8.571-21.143 0-29.714-8-8-21.143-8-29.143 0-34.286 34.857-108 46.857-160.571 46.857s-126.286-12-160.571-46.857c-8-8-21.143-8-29.143 0-8.571 8-8.571 21.143 0 29.714 54.286 54.286 158.857 58.286 189.714 58.286s135.429-4 189.714-58.286zM700 682.857c46.857 0 85.143-38.286 85.143-85.714 0-46.857-38.286-85.143-85.143-85.143-47.429 0-85.714 38.286-85.714 85.143 0 47.429 38.286 85.714 85.714 85.714z"
              ></path>
            </svg>
          </div>
          <div class="image-page-profile">
            <img
              alt="image"
              src="./placeholder.png"
              class="image-page-image"
            />
            <div class="image-page-container1">
              <span class="image-page-text39">John Doe</span>
              <span class="image-page-text40" style="cursor:pointer;">View Profile</span>
            </div>
            <svg viewBox="0 0 1024 1024" class="image-page-follow">
              <path
                d="M384 597.333c58.923 0 112.256-23.893 150.869-62.507 38.571-38.571 62.464-91.904 62.464-150.827s-23.893-112.256-62.464-150.827c-38.613-38.613-91.947-62.507-150.869-62.507s-112.256 23.893-150.869 62.507c-38.571 38.571-62.464 91.904-62.464 150.827s23.893 112.256 62.464 150.827c38.613 38.613 91.947 62.507 150.869 62.507z"
              ></path>
              <path
                d="M384 896c150.101 0 256-42.667 256-85.333 0-85.333-100.437-170.667-256-170.667-160 0-256 85.333-256 170.667 0 42.667 96 85.333 256 85.333z"
              ></path>
              <path
                d="M896 512h-85.333v-85.333c0-23.595-19.072-42.667-42.667-42.667s-42.667 19.072-42.667 42.667v85.333h-85.333c-23.595 0-42.667 19.072-42.667 42.667s19.072 42.667 42.667 42.667h85.333v85.333c0 23.595 19.072 42.667 42.667 42.667s42.667-19.072 42.667-42.667v-85.333h85.333c23.595 0 42.667-19.072 42.667-42.667s-19.072-42.667-42.667-42.667z"
              ></path></svg><svg viewBox="0 0 1024 1024" id="openChat_img" onclick="start_chat_image()" class="image-page-message">
              <path
                d="M768 256h-554.667c-70.4 0-128 57.6-128 128v298.667c0 70.4 57.6 128 128 128h42.667v128l128-128h384c70.4 0 128-57.6 128-128v-298.667c0-70.4-57.6-128-128-128zM810.667 682.667c0 23.125-19.541 42.667-42.667 42.667h-554.667c-23.125 0-42.667-19.541-42.667-42.667v-298.667c0-23.125 19.541-42.667 42.667-42.667h554.667c23.125 0 42.667 19.541 42.667 42.667v298.667z"
              ></path>
              <path
                d="M298.667 618.667c-47.104 0-85.333-38.229-85.333-85.333s38.229-85.333 85.333-85.333 85.333 38.229 85.333 85.333-38.229 85.333-85.333 85.333zM298.667 490.667c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667 42.667-19.115 42.667-42.667-19.115-42.667-42.667-42.667z"
              ></path>
              <path
                d="M490.667 618.667c-47.104 0-85.333-38.229-85.333-85.333s38.229-85.333 85.333-85.333 85.333 38.229 85.333 85.333-38.229 85.333-85.333 85.333zM490.667 490.667c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667 42.667-19.115 42.667-42.667-19.115-42.667-42.667-42.667z"
              ></path>
              <path
                d="M682.667 618.667c-47.104 0-85.333-38.229-85.333-85.333s38.229-85.333 85.333-85.333 85.333 38.229 85.333 85.333-38.229 85.333-85.333 85.333zM682.667 490.667c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667 42.667-19.115 42.667-42.667-19.115-42.667-42.667-42.667z"
              ></path></svg><svg viewBox="0 0 1024 1024" class="image-page-block">
              <path
                d="M512 170.667c-188.203 0-341.333 153.131-341.333 341.333s153.131 341.333 341.333 341.333 341.333-153.131 341.333-341.333-153.131-341.333-341.333-341.333zM298.667 512c0-35.499 9.557-68.437 24.917-97.92l286.336 286.336c-29.483 15.36-62.421 24.917-97.92 24.917-117.632 0-213.333-95.701-213.333-213.333zM700.416 609.92l-286.336-286.336c29.483-15.36 62.421-24.917 97.92-24.917 117.632 0 213.333 95.701 213.333 213.333 0 35.499-9.557 68.437-24.917 97.92z"
              ></path></svg>
              <svg viewBox="0 0 1024 1024" class="image-page-report1" id="svgSubmit2">
              <path
                d="M512 128c-211.755 0-384 172.288-384 384s172.245 384 384 384 384-172.288 384-384-172.245-384-384-384zM512 810.667c-164.651 0-298.667-133.973-298.667-298.667s134.016-298.667 298.667-298.667 298.667 133.973 298.667 298.667-134.016 298.667-298.667 298.667z"
              ></path>
              <path
                d="M542.165 512l112.896-112.896c8.277-8.277 8.277-21.845 0-30.165-8.32-8.277-21.888-8.277-30.165 0l-112.896 112.896-112.896-112.939c-8.32-8.277-21.888-8.277-30.165 0-8.32 8.32-8.32 21.888 0 30.165l112.896 112.939-112.896 112.896c-8.32 8.32-8.32 21.888 0 30.165 4.139 4.181 9.6 6.272 15.061 6.272s10.923-2.091 15.104-6.229l112.896-112.939 112.896 112.896c4.181 4.181 9.643 6.272 15.104 6.272s10.923-2.091 15.104-6.229c8.277-8.277 8.277-21.845 0-30.165l-112.939-112.939z"
              ></path>
            </svg>
            <form action="index.php?modul=report_form_user" method="POST" id="report_user" target="_blank">
  <input type="hidden" name="reported_image" value="value1">
  <input type="hidden" name="reported_model_name" value="value2">
  <input type="hidden" name="reported_u_image" value="value1">
  <input type="hidden" name="reported_u_name" value="value2">
  <input type="hidden" name="reporter_hash" value="value2">
  <input type="hidden" name="reported_hash" value="value2">
  
  <!-- További input mezők szükség szerint -->
  <button type="submit" class="hidden">Küldés</button>
            </form>
          </div>
          <input type="hidden" name="img_userhash" value="value2" id="imguserhash">
          <button type="button" class="image-page-button" onclick="downloadImage();">
            Download .PNG
          </button>
          <button type="button" class="image-page-button1">
            Copy Model Generation Data
          </button>
          <input type="hidden" id="img_ID" name="img_ID" value="itt_az_img_ID_erteke" />
        </div>
      </div>
    </div>

    
        <!-- Chat Box -->
       
<!-- 

<div class="chat-box" id="chatBox">
    <div class="chat-header" id="chatHeader">
        <span class="chatname" id="chatUser">Chat</span>
        <span class="chat-Time" id="chatTime">Time</span>
        <button class="close-chat" id="closeChat">X</button>
    </div>
    <div class="chat-messages" id="chatMessages">
        
    </div>
    <input type="text" id="chatInput" class="chat-input" placeholder="Write a message...">
</div>
 
 -->

    <?php 
    $parts = explode('/', $imgSrc);  // levágjuk az 'img/' részt
    $imgNameWithQuery = end($parts);  // az utolsó elem az, amire szükségünk van
    
    $parts = explode('?', $imgNameWithQuery);  // levágjuk a '?cb=1' részt
    $imgName = $parts[0];  // az első elem az, amire szükségünk van
    
    //echo $imgName;  // ez már a tiszta kép neve, amit átadhatunk a JavaScriptnek
    ?>

  <script>
  var imgSrc = '<?php echo $imgSrc; ?>';
  var imgName = imgSrc.split('/').pop().split('?')[0];
  console.log(imgName);
  document.querySelector('#report_image input[name="reported_image"]').value = imgSrc;
  document.querySelector('#report_user input[name="reported_image"]').value = imgSrc;
  document.querySelector('#report_image input[name="reported_model_name"]').value = imgName;
  document.querySelector('#report_user input[name="reported_model_name"]').value = imgName;
  if (imgName) {
        $.ajax({
            url: 'get_galery.php',
            type: 'GET',
            data: { img_name: imgName },
            success: function(response) {
                var responseObj = JSON.parse(response);
                var img_galeryID = responseObj.img_galeryID;
                var image_names = responseObj.image_names;
                var img_userhash = responseObj.img_userhash;
                console.log(img_galeryID);
               // console.log(responseObj.img_userhash);
               // Itt állítjuk be az img_userhash értéket a <span> data attribútumában
               $('.image-page-text40').attr('data-userhash', img_userhash);
               forum_user_visible();  //comment-hez kell (alap input avatar)
             
// Ellenőrizzük, hogy az img_galeryID 0-e
          if (img_galeryID == 0) {

                    console.log(img_userhash);

                    $.ajax({
                        url: 'get_uploader_datas.php', // Frissítettük az URL-t az új PHP fájlra
                        type: 'GET',
                        data: { userHash: img_userhash }, // Elküldjük a userHash-t a kérés adatként
                        success: function(response) {
                              // A válasz JSON formátumban érkezik, így azt először parse-olni kell
                              var data = JSON.parse(response);

                              // Ellenőrizzük, hogy van-e hiba az adatokban
                              if (!data.error) {
                                  // Sikeres válasz esetén frissítjük az avatár kép útvonalát, ha van img_user
                                  if(data.img_user) {
                                      var avatarSrc = "./img_user/" + data.img_user; // Az avatár kép útvonala
                                      $('.image-page-image').attr('src', avatarSrc); // Az avatár képének frissítése
                                   //   $('#img002').attr('src', avatarSrc);
                                   // document.getElementById("img002").src = avatarSrc;

                                      
                                      console.log(avatarSrc);
                                      document.querySelector('#report_image input[name="reported_u_image"]').value = avatarSrc;
                                      document.querySelector('#report_user input[name="reported_u_image"]').value = avatarSrc;
                                    }

                                  // Ha van User_Name, frissítjük a felhasználó nevét is a felületen
                                  if(data.User_Name) {
                                      $('.image-page-text39').text(data.User_Name); // A felhasználó nevének frissítése
                                      document.querySelector('#report_image input[name="reported_u_name"]').value = data.User_Name;
                                      document.querySelector('#report_user input[name="reported_u_name"]').value = data.User_Name;
                                  }
                              } else {
                                  // Ha van hiba, akkor az kezelése
                                  console.log("Error: " + data.error);
                              }
                          },

                        error: function(xhr, status, error) {
                            // Hiba kezelése
                            console.log("An error occurred: " + error);
                        }
                    });
                    

          
          } else {
            $.ajax({
                    url: 'get_model_datas.php',
                    type: 'GET',
                    data: { img_galeryID: img_galeryID },
                    success: function(response) {
                        var modelData = JSON.parse(response);
                        console.log(modelData); // itt logoljuk a model adatokat
                         // beállítjuk a HTML tartalmát a model adatokkal
                         document.querySelector('#report_user input[name="reported_hash"]').value = modelData.Model_Userhash;
                         document.querySelector('#report_image input[name="reported_hash"]').value = modelData.Model_Userhash;
                         
                      
                        $.ajax({
                        url: 'get_uploader_datas.php', // Frissítettük az URL-t az új PHP fájlra
                        type: 'GET',
                        data: { userHash: modelData.Model_Userhash }, // Elküldjük a userHash-t a kérés adatként
                        success: function(response) {
                              // A válasz JSON formátumban érkezik, így azt először parse-olni kell
                              var data = JSON.parse(response);

                              // Ellenőrizzük, hogy van-e hiba az adatokban
                              if (!data.error) {
                                  // Sikeres válasz esetén frissítjük az avatár kép útvonalát, ha van img_user
                                  if(data.img_user) {
                                      var avatarSrc = "./img_user/" + data.img_user; // Az avatár kép útvonala
                                      $('.image-page-image').attr('src', avatarSrc); // Az avatár képének frissítése
                                      console.log(avatarSrc);
                                      document.querySelector('#report_image input[name="reported_u_image"]').value = avatarSrc;
                                      document.querySelector('#report_user input[name="reported_u_image"]').value = avatarSrc;
                                    }

                                  // Ha van User_Name, frissítjük a felhasználó nevét is a felületen
                                  if(data.User_Name) {
                                      $('.image-page-text39').text(data.User_Name); // A felhasználó nevének frissítése
                                      document.querySelector('#report_image input[name="reported_u_name"]').value = data.User_Name;
                                      document.querySelector('#report_user input[name="reported_u_name"]').value = data.User_Name;
                                  }
                              } else {
                                  // Ha van hiba, akkor az kezelése
                                  console.log("Error: " + data.error);
                              }
                          },

                        error: function(xhr, status, error) {
                            // Hiba kezelése
                            console.log("An error occurred: " + error);
                        }
                    });

                      }
                });

               
              
              } //ezt feljebb, a Model_Userhash helyett az img_userhasht használjuk
            
              }
          });
        }


  $.ajax({
    url: 'get_image_datas.php',
    type: 'POST',
    data: { img_name: imgName },
    success: function(response) {
        var data = JSON.parse(response);
        console.log('Prompt adatok: ' + response);
        
       
        console.log(data.img_ID);
        // El�sz�r meghat�rozzuk az img_ID �rt�k�t, p�ld�ul:
        var img_ID = data.img_ID;
        
        // Majd be�ll�tjuk az �rt�k�t a rejtett mez�h�z:
        document.getElementById("img_ID").value = img_ID;
        countComments(img_ID);

        $('#prompt').text(data.Data_Pos);
        $('#negprompt').text(data.Data_Neg);
        $('#samlingmethod').text(data.Data_Sampling);
        $('#checkpoint').text(data.Data_Check);
        $('#CGFscale').text(data.Data_CFG);
        $('#steps').text(data.Data_Steps);
        $('#seed').text(data.Data_Seed);
        $('#clipskip').text(data.Data_Clip);
        $('#imguserhash').val(data.img_userhash);
    }
});

function countComments(img_ID) {
    $.ajax({
        url: 'count_comments.php',
        type: 'POST',
        data: { img_id: img_ID },
        success: function(response) {
            // Itt kezeljük a szerver válaszát
            console.log('Hozzászólások száma: ' + response);
            $('.image-page-text28 span').text(response);
            // Például frissítheted az UI-t az új információk megjelenítésével
        }
    });
}


var fileName = '<?php echo $imgName; ?>';
$('.image-page-button1').click(function() {
    var link = document.createElement('a');
    link.href = 'download.php?filename=' + fileName;
    link.download = fileName + '.txt';  // Itt használjuk a globális változót
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

$('.image-page-copy-prompt').click(function() {
    var textToCopy = $('#prompt').text();
    navigator.clipboard.writeText(textToCopy).then(function() {
        console.log('Copying to clipboard was successful!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
});

$('.image-page-copy-prompt1').click(function() {
    var textToCopy = $('#negprompt').text();
    navigator.clipboard.writeText(textToCopy).then(function() {
        console.log('Copying to clipboard was successful!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
});

function downloadImage() {
  var imgSrc = document.getElementById('kep').src;
  var imgPath = imgSrc.split('?')[0]; // Levágjuk a '?cb=1' részt, ha nem szükséges
  var link = document.createElement('a');
  link.href = imgPath;
  link.download = ''; // A fájl neve ugyanaz lesz, mint az URL utolsó része
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

  
document.getElementById('svgSubmit2').addEventListener('click', function() {
      var userHash = '<?php echo isset($_SESSION['User_Hash']) ? $_SESSION['User_Hash'] : ''; ?>';
   if (userHash) {
    document.querySelector('#report_user input[name="reporter_hash"]').value = userHash;
    document.getElementById('report_user').submit(); // Az egyedi azonosítóval rendelkező form elküldése
   } else {
    alert('Please log in to access the report.');
   }
});  
document.getElementById('svgSubmit3').addEventListener('click', function() {
      var userHash = '<?php echo isset($_SESSION['User_Hash']) ? $_SESSION['User_Hash'] : ''; ?>';
   if (userHash) {
    document.querySelector('#report_image input[name="reporter_hash"]').value = userHash;
    document.getElementById('report_image').submit(); // Az egyedi azonosítóval rendelkező form elküldése
   } else {
    alert('Please log in to access the report.');
   }
})  
/*
$(document).ready(function() {
  document.getElementById("mycanvas").style.display = "none";
  document.getElementById("generator").addEventListener("click", function(event) {
    var canvas = document.getElementById("mycanvas");
    
    if (canvas.style.display === "none") {
        // Ha a canvas el van rejtve, akkor mutasd meg
        canvas.style.display = "block";
    } else {
        // Ha a canvas látható, akkor rejtsd el
        canvas.style.display = "none";
    }
});


});
*/
$(document).ready(function() {
  
    $('.image-page-text40').click(function() {
        // Az oldal átirányítása az index.php?modul=creator_page oldalra
        var userHash = $(this).attr('data-userhash');
   // window.location.href = 'index.php?modul=creator_page&userhash=' + userHash;
        window.open('index.php?modul=creator_page&userhash=' + userHash, '_blank'); ;
    });
});

/************************************************** */
/*
const graph = new LGraph();
const canvas = new LGraphCanvas("#mycanvas", graph);

const nodesById = {}; // Ez az objektum tárolja a csomópontokat azonosító alapján
// Generikus csomópont osztály
function GenericNode() {
    // Itt hagyjuk ki az addProperties hívást, mivel ez nem része a LiteGraph API-nak
}

GenericNode.title = "Generic";


function extractImgID(imgName) {
    // Eltávolítjuk a fájl kiterjesztését
    var nameWithoutExtension = imgName.split('.').slice(0, -1).join('.');
    
    // Megkeressük az utolsó aláhúzásjelet és kinyerjük az utána lévő számot
    var parts = nameWithoutExtension.split('_');
    var imgID = parts[parts.length - 1];

    return imgID;
}

// Függvény a grafikon konfigurálásához
function configureGraph(graphConfig) {
  if (!graphConfig.nodes || !graphConfig.links) {
        console.error("A graphConfig nem tartalmazza a nodes vagy links tömböket.");
        return;
    }
    const nodeType = "basic/generic"; // Esetleg ellenőrizd, hogy ez a típus létezik-e.
        const node = LiteGraph.createNode(nodeType);

        if (!node) {
            console.error("Nem sikerült létrehozni a csomópontot. Típus:", nodeType);
            return; // Kilép az iterációból, ha a csomópont nem jött létre
        }
    graphConfig.nodes.forEach(nodeData => {
        const genericNode = LiteGraph.createNode("basic/generic");
        genericNode.title = nodeData.type;

        if (Array.isArray(nodeData.inputs)) {
            nodeData.inputs.forEach(input => genericNode.addInput(input.name, input.type));
        }
        if (Array.isArray(nodeData.outputs)) {
            nodeData.outputs.forEach(output => genericNode.addOutput(output.name, output.type));
        }

        if (Array.isArray(nodeData.widgets_values)) {
            nodeData.widgets_values.forEach((value, index) => {
                genericNode.addWidget("text", "Value " + index, value, function(v) {}, "property_name");
            });
        }

        if (nodeData.size) {
            // Átalakítjuk a méret objektumot tömbbé
            var sizeArray = [nodeData.size["0"], nodeData.size["1"]];
            genericNode.size = sizeArray;
        }
        
        genericNode.pos = nodeData.pos;
        graph.add(genericNode);
        nodesById[nodeData.id] = genericNode;
    });

    graphConfig.links.forEach(link => {
        const sourceNodeId = link[1];
        const sourceNodeOutputIndex = link[2];
        const targetNodeId = link[3];
        const targetNodeInputIndex = link[4];

        const sourceNode = nodesById[sourceNodeId];
        const targetNode = nodesById[targetNodeId];

        if (sourceNode && targetNode) {
            sourceNode.connect(sourceNodeOutputIndex, targetNode, targetNodeInputIndex);
        } else {
            console.error("Hiba a kötés létrehozásánál: A forrás vagy a cél csomópont nem létezik.");
        }
    });

    graph.start();
}



// Példa használatra
//var imgName = "ComfyUI_00026_575.png";
console.log(imgID);
var imgID = extractImgID(imgName);
 
fetch('./workflow.json')
  .then(response => response.json())
  .then(graphConfig => {
    configureGraph(graphConfig); // Használjuk a függvényt a betöltött adatokkal
  })
  .catch(error => console.error('Error loading the JSON file:', error));

*/
/*
var globalGraphConfig = null;

function extractImgID(imgName) {
    // Eltávolítjuk a fájl kiterjesztését
    var nameWithoutExtension = imgName.split('.').slice(0, -1).join('.');
    
    // Megkeressük az utolsó aláhúzásjelet és kinyerjük az utána lévő számot
    var parts = nameWithoutExtension.split('_');
    var imgID = parts[parts.length - 1];

    return imgID;
}
var imgID = extractImgID(imgName);
*/
/*
$.ajax({
    url: 'get_graph_data.php',
    type: 'GET',
    data: { imgID: imgID },
    success: function(response) {
        try {
          globalGraphConfig = JSON.parse(response);
            console.log("Elemezett graphConfig (AJAX):", globalGraphConfig);
            buildGraph(globalGraphConfig);
           // configureGraph(globalGraphConfig); // Használjuk a függvényt az AJAX válaszával
        } catch (e) {
            console.error('Error parsing JSON:', e);
        }
    },
    error: function(xhr, status, error) {
        console.error('Error loading graph data:', error);
    }
});


function addMultilineTextWidgetToNode(node) {
    // Létrehoz egy textarea elemet a többsoros szövegmezőhöz
    const textarea = document.createElement("textarea");
    textarea.style.width = "200px"; // Szélesség beállítása
    textarea.style.height = "100px"; // Magasság beállítása

    // Hozzáadja a textarea-t widgetként a csomóponthoz
    node.addWidget("text", "Multiline Text", "", function(value) {
        // Itt kezelheted az érték változását
        console.log("New value:", value);
    }, "property_name", { element: textarea });

    // Beállítja a widget kezdeti értékét, ha szükséges
    textarea.value = "Kezdő érték...";
}


function buildGraph(graphConfig) {
    const graph = new LGraph();
    const canvas = new LGraphCanvas("#mycanvas", graph);
    const nodesById = {};

    function GenericNode() {
        // Itt hagyjuk ki az addProperties hívást, mivel ez nem része a LiteGraph API-nak
    }

    GenericNode.title = "Generic";
    LiteGraph.registerNodeType("basic/generic", GenericNode);
    //LiteGraph.registerWidget("custom/multilinetext", MultilineTextWidget);


    // Feldolgozzuk a nodes és links adatokat
    graphConfig.nodes.forEach(nodeData => {
      const genericNode = LiteGraph.createNode("basic/generic");
        genericNode.title = nodeData.type;

        // Ellenőrizzük, hogy a nodeData tartalmazza-e az inputs és outputs tömböket
        if (Array.isArray(nodeData.inputs)) {
            nodeData.inputs.forEach(input => genericNode.addInput(input.name, input.type));
        }
        if (Array.isArray(nodeData.outputs)) {
            nodeData.outputs.forEach(output => genericNode.addOutput(output.name, output.type));
        }

        // Ellenőrizzük, hogy a widgets_values tömb létezik-e és tömb-e
        if (Array.isArray(nodeData.widgets_values)) {
   // let counter = 1;//parseInt(nodeData.lora_count); // Feltételezzük, hogy van lora_count érték a nodeData-ban

    nodeData.widgets_values.forEach((value, index) => {
        // A LoRA Stacker node-ok speciális kezelése
        if (nodeData.type == "LoRA Stacker") {
            if (index < ((nodeData.widgets_values[1])*4)+2) { //négy mező tartozik egy értékhez, plusz az első kettő
                // Itt adjuk hozzá a widgeteket, de csak a lora_count által meghatározott számig
                genericNode.addWidget("text", "Value " + index, value, function(v) {}, { multiline:true });
            }
            // Ha nem LoRA Stacker, vagy LoRA Stacker, de az index kisebb, mint a lora_count, adjuk hozzá a widgetet
        } else {
            // Minden egyéb esetben hozzáadjuk a widgeteket
            genericNode.addWidget("text", "Value " + index, value, function(v) {}, { multiline:true });
        }
    });
}

            // Méret beállítása
        if (nodeData.size && Array.isArray(nodeData.size)) {
            genericNode.size = [nodeData.size[0], nodeData.size[1]];
        }
        
        genericNode.pos = nodeData.pos;
        graph.add(genericNode);
        nodesById[nodeData.id] = genericNode; // Eltároljuk az azonosító alapján
        console.log(nodesById[nodeData.id]);
    });

    graphConfig.links.forEach(link => {
      const sourceNodeId = link[1];
    const sourceNodeOutputIndex = link[2];
    const targetNodeId = link[3];
    const targetNodeInputIndex = link[4];

    const sourceNode = nodesById[sourceNodeId];
    const targetNode = nodesById[targetNodeId];

    if (sourceNode && targetNode) {
        sourceNode.connect(sourceNodeOutputIndex, targetNode, targetNodeInputIndex);
    } else {
        console.error("Hiba a kötés létrehozásánál: A forrás vagy a cél csomópont nem létezik.");
    }
    });

    graph.start();
} ezt javítani!*/
/*
const graph = new LGraph();
const canvas = new LGraphCanvas("#mycanvas", graph);

const nodesById = {}; // Ez az objektum tárolja a csomópontokat azonosító alapján
// Generikus csomópont osztály
function GenericNode() {
    // Itt hagyjuk ki az addProperties hívást, mivel ez nem része a LiteGraph API-nak
}

GenericNode.title = "Generic";


LiteGraph.registerNodeType("basic/generic", GenericNode);

// A JSON fájl első eleme alapján konfiguráljuk a csomópontot

fetch(globalGraphConfig)
  .then(response => response.json())
  .then(graphConfig => {
    graphConfig.nodes.forEach(nodeData => {
        const genericNode = LiteGraph.createNode("basic/generic");
        genericNode.title = nodeData.type;

        // Ellenőrizzük, hogy a nodeData tartalmazza-e az inputs és outputs tömböket
        if (Array.isArray(nodeData.inputs)) {
            nodeData.inputs.forEach(input => genericNode.addInput(input.name, input.type));
        }
        if (Array.isArray(nodeData.outputs)) {
            nodeData.outputs.forEach(output => genericNode.addOutput(output.name, output.type));
        }

        // Ellenőrizzük, hogy a widgets_values tömb létezik-e és tömb-e
        if (Array.isArray(nodeData.widgets_values)) {
            nodeData.widgets_values.forEach((value, index) => {
                genericNode.addWidget("text", "Value " + index, value, function(v) {}, "property_name");
            });
        }

            // Méret beállítása
        if (nodeData.size && Array.isArray(nodeData.size)) {
            genericNode.size = [nodeData.size[0], nodeData.size[1]];
        }
        
        genericNode.pos = nodeData.pos;
        graph.add(genericNode);
        nodesById[nodeData.id] = genericNode; // Eltároljuk az azonosító alapján
        console.log(nodesById[nodeData.id]);
    });

// Kapcsolatok felépítése a JSON adatok alapján
    graphConfig.links.forEach(link => {
    const sourceNodeId = link[1];
    const sourceNodeOutputIndex = link[2];
    const targetNodeId = link[3];
    const targetNodeInputIndex = link[4];

    const sourceNode = nodesById[sourceNodeId];
    const targetNode = nodesById[targetNodeId];

    if (sourceNode && targetNode) {
        sourceNode.connect(sourceNodeOutputIndex, targetNode, targetNodeInputIndex);
    } else {
        console.error("Hiba a kötés létrehozásánál: A forrás vagy a cél csomópont nem létezik.");
    }
});

    graph.start();
  })
  .catch(error => console.error('Error loading the JSON file:', error));
  */
  $(document).ready(function() {
    $('.image-page-follow').on('click', function() {
        var followedUserHash = $('.image-page-text40').data('userhash');
        var followerUserHash = '<?php echo isset($_SESSION['User_Hash']) ? $_SESSION['User_Hash'] : ''; ?>';

        $.ajax({
            url: 'subscribe.php', // A PHP script elérési útja
            type: 'POST',
            data: {
                followed: followedUserHash,
                follower: followerUserHash
            },
            success: function(response) {
                console.log(response); // Válasz logolása
            },
            error: function(xhr, status, error) {
                console.error("Hiba történt: ", error);
            }
        });
    });
});




//-----CHAT---------------------------------------------------------------
function start_chat_image() {
 
  if (uHash == '') {
      alert('You have to login for chat');
      return;
  }

   
  var userHash_chatpartner = $('.image-page-text40').data('userhash');
//  alert(userHash_chatpartner); 
  if (uHash == userHash_chatpartner) {
      alert('Please choose a valid chat partner!');
      return;
  }  


  allCleanInterval_imagePage();
    
  // Ellenorizzuk, hogy a div letezik-e
  var chatMainDiv = document.getElementById('chat_win');
  var chatModelDiv = document.getElementById('chat_win_model');
  var chatImageDiv = document.getElementById('chat_win_image');

if (chatMainDiv) {
    // Ellenorizzuk, hogy a div nem ures-e
    if (chatMainDiv.innerHTML.trim() !== '') {
        // Kiuritjuk a div tartalmat
        chatMainDiv.innerHTML = '';
    }
}

if (chatModelDiv) {
    if (chatModelDiv.innerHTML.trim() !== '') {
         chatModelDiv.innerHTML = '';
    }
}
 
if (chatImageDiv) {
      if (chatImageDiv.innerHTML.trim() !== '') {
           chatImageDiv.innerHTML = '';
    }
}


  $.ajax({
    type: "post",
    url: '/image/chat/load_chatContent_image.php',
    data: {
      // target_uid: target_uid
    },
    success: function(data_chat_win) {
        //console.log(data_chat_win);
        $('#chat_win_image').html(data_chat_win);


      }
  });

    
  
  
}


//FONTOS! 
//interval valtozok tisztitasa a tobbi chat ablak megnyitas elott/miatt
function allCleanInterval_imagePage() {
  
  //main-chat
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


$(document).ready(function() {

  allCleanInterval_imagePage();
 
  if (typeof closeUserSelectWin === 'function') {
      closeUserSelectWin();
    }   
  if ( (typeof closeChatWindow === 'function') && (typeof intervalId  !== 'undefined') ) {
        closeChatWindow();
    }

  if (typeof closeUserSelectWin_main === 'function') {
      closeUserSelectWin_main();
    }  

    

});


//--------------end:chat-------------------------------------------------------------------------


</script>



   <div id="chat_win_image"></div>

  </body>
</html>
