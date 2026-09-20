<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>StableNemesis</title>
  <!-- Bootstrap CSS -->
  
    <!-- jQuery -->
   
  <!-- Bootstrap JavaScript and Popper.js -->
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="./style.css" />
 
  <style>
   
   :root {
    --bs-orange: #fd7e14;
}


   
   .dropdown-menu {
      max-height: calc(1.5em * 20); /* 20 elem magassága */
      overflow-y: auto;
    }

    .arrow {
      text-align: center;
      cursor: pointer;
    }
    #dropdown-container::-webkit-scrollbar {
  display: none;
}


.list-unstyled li {

   cursor:pointer;

}
.head {

    background-color: rgb(37, 38, 43);
    border-bottom: 1px solid #44454a;
}
.container {
    height: 20px;    /* Változtasd meg az értéket a kívánt magasságra */
    line-height: 20px;    /* Állítsd be ugyanarra az értékre, mint a magasság, hogy a szöveg középen legyen */
    font-size: 14px;    /* Változtasd meg az értéket a kívánt betűméretre */
}
.list-group-item {

    display: inline-block; /* Az a elemeket inline-blokká teszi */
    margin-right: 10px; /* Jobb margó hozzáadása */

    display: block;
    padding: 0.5rem 1rem;
    color: black; /* Szöveg színe */
    text-decoration: none; /* Hivatkozás aláhúzásának eltávolítása */
    border-color: #44454a; /* Keret színe */
    border-width: 1px; /* Keret vastagsága */
    border-radius: 4px; /* Keret lekerekítése */
    background-color: white; /* Háttérszín */
    max-width: 90px;
    margin: 0 10px !important;/* Margó a gombok között */
}
.button {
  color: #c1c2c5; /* Szöveg színe */
    padding: 0.5rem 1rem; /* Padding a szöveg körül */
    border-color: #44454a; /* Keret színe */
    border-width: 1px !important;/* Keret vastagsága */
    border-radius: 4px !important; /* Keret lekerekítése */
    background-color: #2d2e33; /* Háttérszín */
    text-decoration: none; /* Hivatkozás aláhúzásának eltávolítása */
    margin: 0 10px !important; /* Margó a gombok között */
    max-width: 90px; /* Maximális szélesség */
    height: 35px;
    /*border-top-width: 2px !important;*/
    display: flex !important;
    align-items: center;
    justify-content: center;
    border-style: solid !important;
}
.button:hover {
    background-color: #fc7d48 !important;
}
.button:focus {
    background-color: #fc7d48;
}
.list-group {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    border-radius: 0;
}
.list-group-item:hover {
    background-color: #fc7d48 !important;
}
.list-group-item:focus {
	color: white;
}


.btn:hover {
    background-color: #fc7d48 !important;
}
.list-group-item.button:hover {
    background-color: #fc7d48 !important;
}
input {
  border-style: solid !important;
  color: #c1c2c5 !important;
  border-color: #37383d !important;
}

body {
    margin: 0;
    font-family: var(--bs-font-sans-serif);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: rgb(1,1, 1);;
    background-color: rgb(44, 46, 51);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;
}

#dropdownMenuButton:active {
  /*  background-color: #007bff;  /* az aktív gomb színe */
  /*  color: white;  /* a szöveg színe az aktív gombon */
  }
  #dropdownMenuButton:hover, #dropdownMenuButton:focus {
  /*  background-color: #007bff !important;  
    color: white !important; */
  }
  #parent {
  display: flex;
  flex-direction: row-reverse;
  align-items: flex-start;
}
#narrow {
  width: 220px;
  background-color: rgb(37, 38, 43);
  padding: 10px;
  margin: 10px;
  border: 1px solid #44454a;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
 
  min-height: 85vh;
}
#narrowtop {
  display: flex;
  flex-direction: column;
  height: auto;
}
#narrowbottom_lora {
  height: 100px; /* vagy adja meg a kívánt magasságot pixelben */
}
#narrowbottom_lora2 {
  height: 235px; /* vagy adja meg a kívánt magasságot pixelben */
  overflow: hidden !important;
}
#wide {
  flex: 1;
  /* Grow to rest of container */
  background-color: rgb(44, 46, 51);
  color: rgb(193, 194, 197);
  justify-content: center;
  /* Just so it's visible */
}
#narrow_it, #narrow_sfw, #narrow_nsfw, #narrow_poses, #narrow_tools_plugins, #narrow_tutorials, #narrow_styles_checkpoints, #narrow_wildcards, #narrowbottom_lora, #narrowbottom_lora2 {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    
    
    color: rgb(193, 194, 197);
    background-color: rgb(44, 46, 51);
    font-size: 12px;
    padding: 10px;
    margin: 0px;
    overflow: auto;
    white-space: normal;
    word-break: break-word;
    max-height: fit-content;
    border: 1px solid #44454a;
    border-radius: 0;
    cursor: pointer;
  /* Just so it's visible */
}
#narrow_it::-webkit-scrollbar {
  width: 10px; /* Szélesség beállítása */
}

#narrow_it::-webkit-scrollbar-track {
  background: rgb(44, 46, 51); /* Háttérszín beállítása a sávhoz */
}

#narrow_it::-webkit-scrollbar-thumb {
  background: #44454a; /* A görgő színének beállítása */
}

#narrow_it::-webkit-scrollbar-thumb:hover {
  background: #888; /* A görgő színének beállítása, ha rámutatunk */
}
#narrow_cp {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    line-height: 1.55;
    
    color: rgb(193, 194, 197);
    background-color: rgb(44, 46, 51);
    font-size: 12px;
    padding: 10px;
    margin: 0px;
    overflow: auto;
    white-space: normal;
    word-break: break-word;
    max-height: 100px;
    border: 1px solid #44454a;
    border-radius: 0;
  /* Just so it's visible */
}
#narrow_cp::-webkit-scrollbar {
  width: 10px; /* Szélesség beállítása */
}

#narrow_cp::-webkit-scrollbar-track {
  background: rgb(44, 46, 51); /* Háttérszín beállítása a sávhoz */
}

#narrow_cp::-webkit-scrollbar-thumb {
  background: #44454a; /* A görgő színének beállítása */
}

#narrow_cp::-webkit-scrollbar-thumb:hover {
  background: #888; /* A görgő színének beállítása, ha rámutatunk */
}
#narrow_lora {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    line-height: 1.55;
    
    color: rgb(193, 194, 197);
    background-color: rgb(44, 46, 51);
    font-size: 12px;
    padding: 10px;
    margin: 0px;
    overflow: auto;
    white-space: normal;
    word-break: break-word;
    max-height: 100px;
    border: 1px solid #44454a;
    border-radius: 0;
  /* Just so it's visible */
}
#narrow_lora::-webkit-scrollbar {
  width: 10px; /* Szélesség beállítása */
}

#narrow_lora::-webkit-scrollbar-track {
  background: rgb(44, 46, 51); /* Háttérszín beállítása a sávhoz */
}

#narrow_lora::-webkit-scrollbar-thumb {
  background: #44454a; /* A görgő színének beállítása */
}

#narrow_lora::-webkit-scrollbar-thumb:hover {
  background: #888; /* A görgő színének beállítása, ha rámutatunk */
}

.mantine-kwp64y {#0584a5
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
    -webkit-tap-highlight-color: transparent;
    color: #67808d;
    font-size: 12px;
    line-height: 1.55;
    text-decoration: none;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    margin-top: 2px;
    position: relative; /* Hozzáadva */
}
.mantine-kwp64y::before {
    content: "";
    flex: 1 1 0%;
    height: 1px;
    border-top: 1px solid rgb(55, 58, 64);
    margin-right: 10px;
}
.mantine-kwp64y::after {
    content: "";
    flex: 1 1 0%;
    border-top: 1px solid rgb(55, 58, 64);
    margin-left: 10px;
   
}

.mantine-kwp63y {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
    -webkit-tap-highlight-color: transparent;
    color: #67808d;
    font-size: 12px;
    line-height: 1.55;
    text-decoration: none;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    margin-top: 7px;
    position: relative; /* Hozzáadva */
}
.mantine-kwp63y::before {
    content: "";
    flex: 1 1 0%;
    height: 1px;
    border-top: 1px solid rgb(55, 58, 64);
    margin-right: 10px;
}
.mantine-kwp63y::after {
    content: "";
    flex: 1 1 0%;
    border-top: 1px solid rgb(55, 58, 64);
    margin-left: 10px;
    margin-right: 15px;
}
.mantine-kwp63y span {
    position: absolute;
    right: 0;
}
.mantine-kwp63y.open {
    color: #fc7d48;
}

.mantine-kwp63y.open span {
    color: #fc7d48;
}
.mantine-kwp63y.close {
  color: #67808d;
}

.mantine-kwp63y.close span {
  color: #67808d;
}
.arrow {
  text-align: center;
  cursor: pointer;
}

.mantine-1v179jt {
    font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji;
    -webkit-tap-highlight-color: transparent;
    color: inherit;
    font-size: 16px;
    line-height: 1.55;
    -webkit-text-decoration: none;
    text-decoration: none;
    font-weight: 500;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-top: 11px;
    padding-left: 5px;
}
#footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 50px;
  color: rgb(193, 194, 197);
  text-align: left;
  background-color: rgb(37, 38, 43);
  border-top: 1px solid #44454a;
}
.container2 {
  padding: 20px;
  width:100%;/* vagy bármely más érték, amely megfelel az igényeidnek */
  margin: 0 auto;
}
.grid-item img { 
  width: 310px;
  padding: 10px;
        }
  
 .selected-item {
    /* Az alapértelmezett szín, amikor az egér nincs a .selected-item felett. */
    color: rgb(255 255 255); /* Fekete */
    display: inline-block;
    background-color: #747373;
    padding-left: 2px;
    padding-right: 2px;
    margin: 2px;
    border-radius: 3px;
    cursor: pointer;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Fekete szövegárnyék */
    letter-spacing: -0.8px; /* Csökkentett betűköz */
    /* További stílusok */

}
.selected-item2 {
    /* Az alapértelmezett szín, amikor az egér nincs a .selected-item felett. */
    color: rgb(193, 194, 197); /* Fekete */
}

.selected-item:hover {
    /* Az egérmutató a .selected-item felett */
    color: #fc7d48; /* Kék */
}
.selected-item2:hover {
    /* Az egérmutató a .selected-item felett */
    color: #fc7d48; /* Kék */
}
.user {
    position: absolute;
    top: 17px; /*16px*/
    right: 48px;
    z-index: 10;
    padding: 0.5rem 1rem;
    color: #fff;
    text-decoration: none;
  /*  border: 1px solid rgba(0,0,0,.125);*/
    font-size: 14px;
    cursor: pointer;
}
.user:hover {
  color: #fc7d48; 
}
#arrow_narrow_sfw,
#arrow_narrow_nsfw,
#arrow_narrow_styles_checkpoints,
#arrow_narrow_poses,
#arrow_narrow_wildcards,
#arrow_narrow_tools_plugins,
#arrow_narrow_tutorials {
  cursor: pointer;
}
.main-gal-header1 {
    display: flex;
    flex-direction: column;
}

.main-gal-container1,
.main-gal-buttons {
    width: 100%;
}
.spacer {
    display: inline-block;
    width: 10px;
}
.list-group-item {
    display: inline-block; /* Az a elemeket inline-blokká teszi */
    margin-right: 10px; /* Jobb margó hozzáadása */
}
.button-with-margin {
    margin-right: 10px !important;
}
.list-group-item-action:hover {
    background-color: #fd7e14 !important;
}
.main-gal-icon12 {
  fill: #fc7d48;
  left: 325px;
  width: 40px;
  bottom: 1px;
  height: 32px;
  position: absolute;
}
.main-gal-icon02 {
  fill: #fc7d48;
  width: 30px;
  height: 15px;
  vertical-align: middle; position: absolute; top: 31px; left: 306px;
}
.main-gal-icon04 {
  fill: #fc7d48;
  width: 30px;
  height: 18px;
  vertical-align: middle; position: absolute; top: 30px; left: 374px;
}
.main-gal-icon06 {
    fill: #fc7d48;
    width: 30px;
    height: 21px;
    vertical-align: middle;
    position: absolute;
    top: 30px;
    left: 430px;
}
.main-gal-icon {
  
  fill: rgb(252, 125, 72);
    vertical-align: middle;
    /* position: absolute; */
    top: 31px;
    left: 950px;
    width: 31px;
    height: 16px;
    position: absolute;
    cursor: pointer;
    z-index: 1;
}
.main-gal-textinput, .main-gal-textinput:focus {
    color: var(--dl-color-gray-white);
    height: 36px;
    vertical-align: middle; 
    position: absolute; 
    top: 0px; 
    left: 69px;
    border: 1px solid #44454a !important;
    background-color: #2d2e33;
    border-radius: 0px;
    font-size: 14px;
    width: 425px;
    padding-left: 10px;
}
.news {
  position: absolute; top: -47px; left: 1008px;
  background-color: #14a9ff;

}
.chalenge {
  position: absolute; top: -47px; left: 1137px;
  background-color: #ef4343;
}

.turorials {
  position: absolute; top: -47px; left: 1266px;
  background-color: #7accc8;
}

.beta{
  position: absolute; top: -47px; left: 1395px; 
  background-color: #fc7d48;
}

.new-buttons-t{
  vertical-align: middle; 
  font-size: 16px;
  color: white;
  width: 885px;
  height: 30px;  /*21px;*/
	line-height: 30px; /*vertikalisan kozepre igazit**/
	text-align: center; /*horizontalisan kozepre igazit**/
	text-decoration: none; /* Hivatkozás aláhúzásának eltávolítása */
	border-color: #44454a; /* Keret színe */
	border-width: 1px; /* Keret vastagsága */
	border-radius: 4px; /* Keret lekerekítése */
	/*background-color: #fc7d48;*/ /* Háttérszín */
	max-width: 90px;
}
.new-buttons-t:hover {
    background-color: #fc7d48 !important;
	color: white;
}

.register-t{
  background-color: #ef4343;
  padding: 0px 20px;


}
.login-t{
  background-color: #14a9ff;
    padding: 0px 20px;
	margin-left: 10px;
}






.main-gal-icon10 {
    top: 0px;
    fill: #D9D9D9;
    right: 39px;
    width: 62px;
    bottom: -87px;
    height: 20px;
    margin: auto;
    position: absolute;
    cursor: pointer;
}
.jobbszelre {
  position: absolute; 
  width: 100%;
  /*right: 500px;*/
}
#newbutton1 {
 /* background-color: #fc7d48 !important;*/
 font-size: 16px;
}
#newbutton2 {
 /* background-color: #fc7d48 !important;*/
 font-size: 16px;
}
#newbutton3 {
 /* background-color: #fc7d48 !important;*/
 font-size: 16px;
}
.my-active-button {
  background-color: #fc7d48 !important;
  color: white;
  border-color: #000000;
 font-size: 16px;

}


.download {
  top: 0px;
  fill: #D9D9D9;
  right: 43px;
    width: 20px;
    bottom: -87px;
  height: 20px;
  margin: auto;
  position: absolute;
}
.main-gal-icon08 {
  top: 6px;
  fill: #fc7d48;
  right: 88px;
  width: 30px;
  height: 30px;
  position: absolute;
}
.categories-message {
  top: 6px;
  fill: var(--dl-color-primary-500);
  right: 130px;
  width: 30px;
  height: 30px;
  position: absolute;
}



body.modal-open {
  background-color: rgb(44, 46, 51); 
  overflow: hidden;
  /* a testre vonatkozó stílusok, amikor a modális ablak nyitva van */
}
.modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 0px;
    background-color: rgb(37, 38, 43);
}
.modal-close-button {
  /* Itt lehetnek további stílusok, hogy a gomb a kívánt helyen legyen */
 /* right: 43px;
    width: 20px;
    bottom: -87px;
  height: 20px;
  margin: auto;
  position: absolute;*/
}
.modal-dialog {
  overflow-y: hidden;
  margin: 0;
  padding: 0;
  max-width: 100%;
}
.modal-content {
  padding: 0;
  border: none;
}
.user-settings-profile2 {
    top: 0px;
    right: 0px;
    width: 51px;
    display: flex;
    position: absolute;
    align-items: center;
    flex-direction: row;
    justify-content: flex-start;
}
.user-settings-image {
    width: var(--dl-size-size-small);
    height: var(--dl-size-size-small);
    object-fit: cover;
    border-color: var(--dl-color-gray-black);
    border-width: 1px;
    border-radius: var(--dl-radius-radius-round);
} /**/
.search-container {
  position: absolute;
     top: 22px; 
     left: 490px;
}

.dropdown-content {
  font-size: 14px;
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      width: 71px;
      
     /* box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
      z-index: 1;
    }
    .menu-item {
      color: black;
      padding: 3px 8px;
      display: block;
      text-align: left;
      text-decoration: none;
      height: 33px;
      border: 1px solid #44454a;
      background-color: #2d2e33;
      color: #c1c2c5;
      font-size: 16px;
    }
    .drop {
      height: 36px;
      width: 71px;
      font-size: 16px;
      padding: 3px 5px;
      text-align: left;
      border: 1px solid #44454a;
      background-color: #2d2e33;
      color: rgb(252, 125, 72);
    }
    .drop::after {
  content: "\25BC";  /* Egy lefele mutató nyíl Unicode karakter */
  font-size: 10px;
  position: absolute;
  right: 6px;
  top: 50%;
  transform: translateY(-50%);
  color: rgb(252, 125, 72);
}
input:focus {
  outline: none;
}
.dropdown {
 /*position: absolute;*/
/* display: inline-block;*/
}

.dropdown-content2 {
  display: none;
  position: absolute;
 
  min-width: 95px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 100;
  right:60px;
  top:60px;
  border-color: #37383d;
    border-style: solid;
    border-width: 1px;
    padding-left: 0px;
    justify-content: center;
    background-color: #25262b;
    color: #c1c2c5;
    font-size: 14px;
}



.sort-option:hover {
  background-color: #f1f1f1;
}
.dropdown-content2.show {
    display: block;
}
.sort-option {
    padding: 2px 6px !important;
    display: block !important;
    color: #c1c2c5;
    text-decoration: none !important;
}

.sort-option a {
    color: #0d6efd !important;
    text-decoration: none !important;
}
.custom-modal-dialog {
    margin: auto;
    max-width: 500px;
    color: #c1c2c5;
  }
  .btn-secondary {
    color: #fff;
    background-color: #2d2e33 !important;
    border-color: #6c757d;
  }
  .modal-body1 {
    padding-left:10px;
  }
  .error-info {
    color: red;
    font-size: 0.8em; /* Kisebb betűméret */
    /* További stílusok... */
}

.model-info {
    color: white;
    font-size: 14px; /* Alapértelmezett betűméret */
    /* További stílusok... */
}

.main-gal-icon0222 {
    fill: #fc7d48;
    width: 30px;
    height: 13px;
    vertical-align: middle;
    position: absolute;
    top: 17px;
    left: 147px;
}
.main-info-icon0222 {
    fill: #fc7d48;
    width: 30px;
    height: 13px;
    vertical-align: middle;
    position: absolute;
    top: 3px;
    left: -5px;
}
.main-gal-icon0444 {
    fill: #fc7d48;
    width: 30px;
    height: 16px;
    vertical-align: middle;
    position: absolute;
    top: 17px;
    left: 199px;
}
.main-gal-icon0666 {
    fill: #fc7d48;
    width: 30px;
    height: 16px;
    vertical-align: middle;
    position: absolute;
    top: 17px;
    left: 252px;
}
.like_n {
  font-size: 12px;
    color: #fc7d48;
    width: 30px;
    height: 16px;
    vertical-align: middle;
    position: absolute;
    top: 1px;
    left: 151px;
}
.chat_n {
  font-size: 12px;
    color: #fc7d48;
    width: 30px;
    height: 16px;
    vertical-align: middle;
    position: absolute;
    top: 1px;
    left: 200px;
}
.down_n {
  font-size: 12px;
    color: #fc7d48;
    width: 30px;
    height: 16px;
    vertical-align: middle;
    position: absolute;
    top: 1px;
    left: 252px;
}
.info-overlay {
  padding: '10px';
}
#narrow_search2 {
  display: block;
}

  .main-gal-textinput2, .main-gal-textinput2:focus {
    color: var(--dl-color-gray-white);
    height: 28px;
    vertical-align: middle;
    position: relative;
    top: 6px;
    left: 0px;
    border: 1px solid #44454a !important;
    background-color: #2d2e33;
    border-radius: 0px;
    font-size: 14px;
    width: 199px;
    padding-left: 7px;
}
#narrowselect {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    color: rgb(193, 194, 197);
    background-color: rgb(44, 46, 51);
    font-size: 12px;
    padding: 10px;
    margin: 0px;
    overflow: auto;
    white-space: normal;
    word-break: break-word;
    max-height: fit-content;
    border: 1px solid #44454a;
    border-radius: 0;
    cursor: pointer;
}
.select_generator {
    color: rgb(255 255 255);
    display: inline-block;
    background-color: #747373;
    padding-left: 2px;
    padding-right: 2px;
    margin: 2px;
    border-radius: 3px;
    cursor: pointer;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    letter-spacing: -0.8px;
}
#narrowselect2 {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    color: rgb(193, 194, 197);
    background-color: rgb(44, 46, 51);
    font-size: 12px;
    padding: 10px;
    margin: 0px;
    overflow: auto;
    white-space: normal;
    word-break: break-word;
    max-height: fit-content;
    border: 1px solid #44454a;
    border-radius: 0;
    cursor: pointer;
}


</style>

 
   
</head>
<body>


<div style="height: 120px;" class="head">
    <div style="height: 50px;">
        <img src="public/external/r34-200h.png" alt="Logo" style="height: 97px; vertical-align: middle; position: absolute; top: -6px; left: 4px; cursor:pointer;" id="imageL" z-index="10">
        <svg viewBox="0 0 1024 1024" class="main-gal-icon02">
          <path d="M755.188 64c-107.63 0-200.258 87.554-243.164 179-42.938-91.444-135.578-179-243.216-179-148.382 0-268.808 120.44-268.808 268.832 0 301.846 304.5 380.994 512.022 679.418 196.154-296.576 511.978-387.206 511.978-679.418 0-148.392-120.43-268.832-268.812-268.832z"></path>
        </svg>
        <svg viewBox="0 0 1024 1024" class="main-gal-icon04">
          <path d="M402.286 219.429c-178.286 0-329.143 100.571-329.143 219.429 0 62.857 42.286 123.429 115.429 165.714l55.429 32-20 48c12-6.857 24-14.286 35.429-22.286l25.143-17.714 30.286 5.714c28.571 5.143 57.714 8 87.429 8 178.286 0 329.143-100.571 329.143-219.429s-150.857-219.429-329.143-219.429zM402.286 146.286c222.286 0 402.286 130.857 402.286 292.571s-180 292.571-402.286 292.571c-34.857 0-68.571-3.429-100.571-9.143-47.429 33.714-101.143 58.286-158.857 73.143-15.429 4-32 6.857-49.143 9.143h-1.714c-8.571 0-16.571-6.857-18.286-16.571v0c-2.286-10.857 5.143-17.714 11.429-25.143 22.286-25.143 47.429-47.429 66.857-94.857-92.571-53.714-152-136.571-152-229.143 0-161.714 180-292.571 402.286-292.571zM872 814.286c19.429 47.429 44.571 69.714 66.857 94.857 6.286 7.429 13.714 14.286 11.429 25.143v0c-2.286 10.286-10.857 17.714-20 16.571-17.143-2.286-33.714-5.143-49.143-9.143-57.714-14.857-111.429-39.429-158.857-73.143-32 5.714-65.714 9.143-100.571 9.143-103.429 0-198.286-28.571-269.714-75.429 16.571 1.143 33.714 2.286 50.286 2.286 122.857 0 238.857-35.429 327.429-99.429 95.429-69.714 148-164 148-266.286 0-29.714-4.571-58.857-13.143-86.857 96.571 53.143 159.429 137.714 159.429 233.143 0 93.143-59.429 175.429-152 229.143z"></path>
        </svg>
        <svg viewBox="0 0 1024 1024" class="main-gal-icon06">
          <path d="M214 768h596v86h-596v-86zM810 384l-298 298-298-298h170v-256h256v256h170z"></path>
        </svg>
        <svg viewBox="0 0 950.8571428571428 1024" class="main-gal-icon">
          <path d="M658.286 475.429c0-141.143-114.857-256-256-256s-256 114.857-256 256 114.857 256 256 256 256-114.857 256-256zM950.857 950.857c0 40-33.143 73.143-73.143 73.143-19.429 0-38.286-8-51.429-21.714l-196-195.429c-66.857 46.286-146.857 70.857-228 70.857-222.286 0-402.286-180-402.286-402.286s180-402.286 402.286-402.286 402.286 180 402.286 402.286c0 81.143-24.571 161.143-70.857 228l196 196c13.143 13.143 21.143 32 21.143 51.429z"></path>
        </svg>
        <div class="search-container">
          <input type="text" placeholder="Search..." id="searchQuery1" class="main-gal-textinput">
          
          <button id="dropdownMenuButton" class="drop">Model</button>
          <div id="dropdownMenu" class="dropdown-content">
            <a href="#" class="menu-item" data-value="user">User</a>
          </div>
          <input type="hidden" id="searchType" value="model" >
        </div>






    </div>
    <div style="display: flex; align-items: center; position: absolute; top: 72px; left: 8px;" id="special-buttons">
        
        <a href="#" class="list-group-item list-group-item-action button" type="button" id="newButton1" style="margin-right: 10px;">
            Models
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button" id="newButton2" style="margin-right: 10px;">
            Images
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button" id="newButton3" style="margin-right: 10px;">
            Workflow
        </a>
        <svg viewBox="0 0 1024 1024" class="main-gal-icon12">
              <path d="M584.832 755.499l213.333-213.333c16.683-16.683 16.683-43.691 0-60.331l-213.333-213.333c-16.683-16.683-43.691-16.683-60.331 0s-16.683 43.691 0 60.331l183.168 183.168-183.168 183.168c-16.683 16.683-16.683 43.691 0 60.331s43.691 16.683 60.331 0zM286.165 755.499l213.333-213.333c16.683-16.683 16.683-43.691 0-60.331l-213.333-213.333c-16.683-16.683-43.691-16.683-60.331 0s-16.683 43.691 0 60.331l183.168 183.168-183.168 183.168c-16.683 16.683-16.683 43.691 0 60.331s43.691 16.683 60.331 0z"></path>
        </svg>
		<a href="#" class="news new-buttons-t" type="button">News</a>
	    <!--
    	<a href="#" class="chalenge new-buttons-t" type="button">Challenge</a>
		<a href="#" class="turorials new-buttons-t" type="button">Tutorials</a>
		<a href="#" class="beta new-buttons-t" type="button">Beta</a>    -->
  
    </div>
    <div class="container" style="position: absolute; left: 370px; display: flex; justify-content: flex-start; align-items: center; padding: 0 0px; height: 80px;">

        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px;">
            All
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px;">
            SFW
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px;">
            NSFW
        </a>
        
        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px;">
            Poses
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px; max-width: 100px;">
            Wildcards
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px; max-width: 120px;">
            Tools/Plugins
        </a>
        <a href="#" class="list-group-item list-group-item-action button" type="button"  style="margin-right: 10px; max-width: 100px;">
            Tutorials
        </a>

    </div>


<div class="user">
<?php
    // session_start();
   // $showCircle=false;
    if(isset($_SESSION['User_Hash'])){
        // A $_SESSION['User_Hash'] értékét JavaScript változóba mentjük
        echo '<script>var userHash = "'.$_SESSION['User_Hash'].'";</script>';

       // echo ' <span id="user-name"></span> ';
      //  echo '<a href="logout.php">Kilépés</a>'; // Hozzáadjuk a "Kilépés" linket
      echo'
      <div class="user-settings-profile2" id="profil_image">
      <img alt="image" src="./placeholder.png" class="user-settings-image">
    </div>
    ';

		echo '<svg viewBox="0 0 1024 1024"  id="openChat" onclick="start_chat()" class="categories-message">
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
              ></path>
            </svg>';

        echo '<svg viewBox="0 0 1024 1024" class="main-gal-icon08" id="add_new_model">
        <path d="M342 556l170-172 170 172-60 60-68-68v178h-84v-178l-68 68zM854 768v-426h-684v426h684zM854 256q34 0 59 26t25 60v426q0 34-25 60t-59 26h-684q-34 0-59-26t-25-60v-512q0-34 25-60t59-26h256l86 86h342z"></path>
            </svg>';
    } else {
        echo '<a href="register.php" class="register-t new-buttons-t" type="button">Register</a>';
        echo '<a href="login.php" class="login-t new-buttons-t" type="button">Log In</a>'; // Helyettesítsd a "login.php"-t a bejelentkező oldalad címével
    }
    ?>
</div>
<div class="jobbszelre">
  <div class="dropdown">
    <svg viewBox="0 0 1040.6034285714286 1024" class="main-gal-icon10" onclick="toggleDropdown()">
      <!-- SVG path itt -->
          <path d="M420.571 822.857c0 5.143-2.286 9.714-5.714 13.714l-182.286 182.286c-4 3.429-8.571 5.143-13.143 5.143s-9.143-1.714-13.143-5.143l-182.857-182.857c-5.143-5.714-6.857-13.143-4-20s9.714-11.429 17.143-11.429h109.714v-786.286c0-10.286 8-18.286 18.286-18.286h109.714c10.286 0 18.286 8 18.286 18.286v786.286h109.714c10.286 0 18.286 8 18.286 18.286zM1024 896v109.714c0 10.286-8 18.286-18.286 18.286h-475.429c-10.286 0-18.286-8-18.286-18.286v-109.714c0-10.286 8-18.286 18.286-18.286h475.429c10.286 0 18.286 8 18.286 18.286zM914.286 603.429v109.714c0 10.286-8 18.286-18.286 18.286h-365.714c-10.286 0-18.286-8-18.286-18.286v-109.714c0-10.286 8-18.286 18.286-18.286h365.714c10.286 0 18.286 8 18.286 18.286zM804.571 310.857v109.714c0 10.286-8 18.286-18.286 18.286h-256c-10.286 0-18.286-8-18.286-18.286v-109.714c0-10.286 8-18.286 18.286-18.286h256c10.286 0 18.286 8 18.286 18.286zM694.857 18.286v109.714c0 10.286-8 18.286-18.286 18.286h-146.286c-10.286 0-18.286-8-18.286-18.286v-109.714c0-10.286 8-18.286 18.286-18.286h146.286c10.286 0 18.286 8 18.286 18.286z"></path>
        </svg>
    <div id="myDropdown" class="dropdown-content2">
      <a href="#" class="sort-option" data-sort="recent">Recent</a>
      <a href="#" class="sort-option" data-sort="day">Day</a>
      <a href="#" class="sort-option" data-sort="week">Week</a>
      <a href="#" class="sort-option" data-sort="month">Month</a>
      <a href="#" class="sort-option" data-sort="year">Year</a>
      <a href="#" class="sort-option" data-sort="best">Best rate</a>
    </div>
  </div>

</div>

</div>

<div id="dropdown-container" class="list-group" style="display: none; max-height: 410px; max-width: 200px;  overflow: auto; position: absolute; top: 52px; z-index: 10;">
    
</div>
  
<div id="parent"> 

</div>

<!-- Modal -->
<!-- Bootstrap modal css kell! -->

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered custom-modal-dialog">
    <div class="modal-content" style="background-color: #424242;">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to add a new item?</p>
        <label for="itemSelect">Choose an item to add:</label>
        <select class="form-select" id="itemSelect">
          <option value="item1">Model</option>
          <option value="item2">Image</option>
          <option value="item3">Video</option>
        </select>
    
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="button" id="confirmAdd" class="btn btn-secondary">Confirm</button>
      
      </div>
    </div>
  </div>
</div>



<!-- ModalGalery -->



<div class="modal" tabindex="-1" id="myModal2">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-body" id="modal-body" style="padding: 0px;">
        <!-- Itt lesznek a képek -->
      </div>

    </div>
  </div>

</div>

<!-- Nagy kép modális ablaka -->
<div class="modal" id="largeImageModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            
             

            <div class="modal-body" style="padding: 0px;">
             <!-- Itt lesz az image_page.php -->    
           
            </div>
            
        </div>
    </div>
</div>



<!-- popUp menü -->

<div class="user-pop-up-window-pop-up">
          <button type="button" class="user-pop-up-window-my-models">
            <span class="user-pop-up-window-text12">My Models</span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon10">
              <path
                d="M810 726v-44q0-38-59-61t-111-23-111 23-59 61v44h340zM640 384q-34 0-60 26t-26 60 26 59 60 25 60-25 26-59-26-60-60-26zM854 256q34 0 59 26t25 60v426q0 34-25 60t-59 26h-684q-34 0-59-26t-25-60v-512q0-34 25-60t59-26h256l86 86h342z"
              ></path>
            </svg>
          </button>
          <button type="button" class="user-pop-up-window-my-galleries">
            <span class="user-pop-up-window-text13">My Gallery</span>
            <svg viewBox="0 0 1152 1024" class="user-pop-up-window-icon12">
              <path
                d="M1088 128h-64v-64c0-35.2-28.8-64-64-64h-896c-35.2 0-64 28.8-64 64v768c0 35.2 28.8 64 64 64h64v64c0 35.2 28.8 64 64 64h896c35.2 0 64-28.8 64-64v-768c0-35.2-28.8-64-64-64zM128 192v640h-63.886c-0.040-0.034-0.082-0.076-0.114-0.116v-767.77c0.034-0.040 0.076-0.082 0.114-0.114h895.77c0.040 0.034 0.082 0.076 0.116 0.116v63.884h-768c-35.2 0-64 28.8-64 64v0zM1088 959.884c-0.034 0.040-0.076 0.082-0.116 0.116h-895.77c-0.040-0.034-0.082-0.076-0.114-0.116v-767.77c0.034-0.040 0.076-0.082 0.114-0.114h895.77c0.040 0.034 0.082 0.076 0.116 0.116v767.768z"
              ></path>
              <path
                d="M960 352c0 53.020-42.98 96-96 96s-96-42.98-96-96 42.98-96 96-96 96 42.98 96 96z"
              ></path>
              <path d="M1024 896h-768v-128l224-384 256 320h64l224-192z"></path>
            </svg>
          </button>
          <button type="button" class="user-pop-up-window-down-models">
            <span class="user-pop-up-window-text14">
              <span>Downloaded Models</span>
              <br />
            </span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon16">
              <path
                d="M576 256l-128-128h-448v832h1024v-704h-448zM512 864l-224-224h160v-256h128v256h160l-224 224z"
              ></path>
            </svg>
          </button>
          <button type="button" class="user-pop-up-window-down-models1">
            <span class="user-pop-up-window-text17-0">
              <span>Bookmarks</span>
              <br />
            </span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon18-0">
              <path
                d="M1024 397.050l-353.78-51.408-158.22-320.582-158.216 320.582-353.784 51.408 256 249.538-60.432 352.352 316.432-166.358 316.432 166.358-60.434-352.352 256.002-249.538zM512 753.498l-223.462 117.48 42.676-248.83-180.786-176.222 249.84-36.304 111.732-226.396 111.736 226.396 249.836 36.304-180.788 176.222 42.678 248.83-223.462-117.48z"
              ></path>
            </svg>
          </button>
          <button
            type="button"
            class="user-pop-up-window-creators-follow"
          >
            <span class="user-pop-up-window-text17">
              <span>Followed Creators</span>
              <br />
            </span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon18">
              <path
                d="M554 554q80 0 168 35t88 93v86h-512v-86q0-58 88-93t168-35zM838 562q74 12 130 43t56 77v86h-128v-86q0-68-58-120zM554 470q-52 0-90-38t-38-90 38-90 90-38 90 38 38 90-38 90-90 38zM768 470q-20 0-38-6 38-54 38-122t-38-122q18-6 38-6 52 0 90 38t38 90-38 90-90 38zM342 426v86h-128v128h-86v-128h-128v-86h128v-128h86v128h128z"
              ></path>
            </svg>
          </button>

          <button type="button" class="user-pop-up-window-settings">
            <span class="user-pop-up-window-text20">
              <span>Settings</span>
              <br />
            </span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon20">
              <path
                d="M363.722 722.052l41.298-57.816-45.254-45.256-57.818 41.296c-10.722-5.994-22.204-10.774-34.266-14.192l-11.682-70.084h-64l-11.68 70.086c-12.062 3.418-23.544 8.198-34.266 14.192l-57.818-41.298-45.256 45.256 41.298 57.816c-5.994 10.72-10.774 22.206-14.192 34.266l-70.086 11.682v64l70.086 11.682c3.418 12.060 8.198 23.544 14.192 34.266l-41.298 57.816 45.254 45.256 57.818-41.296c10.722 5.994 22.204 10.774 34.266 14.192l11.682 70.084h64l11.68-70.086c12.062-3.418 23.544-8.198 34.266-14.192l57.818 41.296 45.254-45.256-41.298-57.816c5.994-10.72 10.774-22.206 14.192-34.266l70.088-11.68v-64l-70.086-11.682c-3.418-12.060-8.198-23.544-14.192-34.266zM224 864c-35.348 0-64-28.654-64-64s28.652-64 64-64 64 28.654 64 64-28.652 64-64 64zM1024 384v-64l-67.382-12.25c-1.242-8.046-2.832-15.978-4.724-23.79l57.558-37.1-24.492-59.128-66.944 14.468c-4.214-6.91-8.726-13.62-13.492-20.13l39.006-56.342-45.256-45.254-56.342 39.006c-6.512-4.766-13.22-9.276-20.13-13.494l14.468-66.944-59.128-24.494-37.1 57.558c-7.812-1.892-15.744-3.482-23.79-4.724l-12.252-67.382h-64l-12.252 67.382c-8.046 1.242-15.976 2.832-23.79 4.724l-37.098-57.558-59.128 24.492 14.468 66.944c-6.91 4.216-13.62 8.728-20.13 13.494l-56.342-39.006-45.254 45.254 39.006 56.342c-4.766 6.51-9.278 13.22-13.494 20.13l-66.944-14.468-24.492 59.128 57.558 37.1c-1.892 7.812-3.482 15.742-4.724 23.79l-67.384 12.252v64l67.382 12.25c1.242 8.046 2.832 15.978 4.724 23.79l-57.558 37.1 24.492 59.128 66.944-14.468c4.216 6.91 8.728 13.618 13.494 20.13l-39.006 56.342 45.254 45.256 56.342-39.006c6.51 4.766 13.22 9.276 20.13 13.492l-14.468 66.944 59.128 24.492 37.102-57.558c7.81 1.892 15.742 3.482 23.788 4.724l12.252 67.384h64l12.252-67.382c8.044-1.242 15.976-2.832 23.79-4.724l37.1 57.558 59.128-24.492-14.468-66.944c6.91-4.216 13.62-8.726 20.13-13.492l56.342 39.006 45.256-45.256-39.006-56.342c4.766-6.512 9.276-13.22 13.492-20.13l66.944 14.468 24.492-59.13-57.558-37.1c1.892-7.812 3.482-15.742 4.724-23.79l67.382-12.25zM672 491.2c-76.878 0-139.2-62.322-139.2-139.2s62.32-139.2 139.2-139.2 139.2 62.322 139.2 139.2c0 76.878-62.32 139.2-139.2 139.2z"
              ></path>
            </svg>
          </button>
          <button type="button" class="user-pop-up-window-log-out">
            <span class="user-pop-up-window-text23">Logout</span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon22">
              <path
                d="M810 128q34 0 60 26t26 60v596q0 34-26 60t-60 26h-596q-36 0-61-25t-25-61v-170h86v170h596v-596h-596v170h-86v-170q0-36 25-61t61-25h596zM430 666l110-112h-412v-84h412l-110-112 60-60 214 214-214 214z"
              ></path>
            </svg>
          </button>
		  <button type="button" class="user-pop-up-window-log-out1">
            <span class="user-pop-up-window-text27">Mod</span>
            <svg viewBox="0 0 1024 1024" class="user-pop-up-window-icon26">
              <path
                d="M840 708l-562-562 234-104 384 172v256q0 122-56 238zM950 928l-54 54-146-146q-104 114-238 146-164-40-274-187t-110-325v-256l-86-86 54-54 222 222t260 259 222 221z"
              ></path>
            </svg>
          </button>

        </div>


    <script>


$(document).ready(function() {

  // Menü kezelése
  $('body').on('click', '#dropdownMenuButton', function(event) {
    event.stopPropagation();
    var oppositeValue = $("#dropdownMenuButton").text() === "Model" ? "User" : "Model";
    $(".menu-item").text(oppositeValue).attr("data-value", oppositeValue);
    $("#dropdownMenu").toggle();
  });
  
  $('body').on('click', '.menu-item', function(event) {
    event.stopPropagation();
    var value = $(this).attr("data-value");
    $("#searchType").val(value);
    $("#dropdownMenuButton").text(value);
    $("#dropdownMenu").hide();
  });

  // Globális kattintás figyelése
  $(document).click(function() {
    $("#dropdownMenu").hide();
  });


  // Betöltjük a parent.php tartalmát az #parent div-be
  $('#parent').load('parent.php', function(response, status, xhr) {
    if (status == "success") {
      console.log("A tartalom sikeresen betöltődött.");
//keresés   
/*
/$("#dropdownMenuButton").click(function() {
      $("#dropdownMenu").toggle();
    });
    $(".menu-item").click(function() {
      var value = $(this).attr("data-value");
      $("#searchType").val(value);
      $("#dropdownMenuButton").text(value);
      $("#dropdownMenu").hide();
    });
    */
    // Keresés indítása az ikonra kattintva
    $("#searchQuery1").on('keyup', function(e) {
        if (e.keyCode === 13) { // ENTER gomb kódja
            initiateSearch();
        }
    });
    $("svg.main-gal-icon").on('click', function() {
            initiateSearch();
});


    // Egyelőre csak "model" keresést teszünk lehetővé
    function initiateSearch() {
    var searchQuery = $("#searchQuery1").val(); // A keresési mező tartalma
    var searchTable = $("#searchType").val(); // "model" vagy "users"
    

    // Meghívjuk a loadImages függvényt a keresési paraméterekkel
    loadImages(null, null, 1, searchQuery, null, searchTable);
}
      
    } else {
      console.error("Hiba történt: " + xhr.status + " " + xhr.statusText);
    }
  });

});

function closeModal() {
  var myModal = new bootstrap.Modal(document.getElementById('myModal2'));
  myModal.hide();
  
  // Töröljük az állapotot a history-ból
  window.history.replaceState(null, null, null);
}


/*
$(document).ready(function() {
  $('#dropdownMenuButton1').on('click', function() {
    $('#dropdownMenu').toggle();
  });

  $('.menu-item').on('click', function() {
    var value = $(this).attr('data-value');
    $('#dropdownMenuButton1').text(value.charAt(0).toUpperCase() + value.slice(1));
    $('#searchType').val(value);
    $('#dropdownMenu').hide();
  });
});
*/
/*
$(document).ready(function() {
  function getURLParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Használat:
  const currentCategory = decodeURIComponent(getURLParameter('currentCategory'));

  //loadImages(null, null, 1);
});


//let currentCategory = null; // Alapértelmezett érték




/*,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,*/
/*
$("#newButton2").click(function() {
    $("#parent").load("parent.php?currentCategory=SFW");
});
*/

// Globális változó és függvény
var buttonText;

var codeAlreadyRan = false;

$("#newButton22").off('click').click(function() {
    // Visszaállítjuk az állapotot minden kattintáskor
    codeAlreadyRan = false;

    $.ajax({
        url: "parent.php",
        type: "GET",
        data: { currentCategory: "SFW" },
        success: function(response) {
            $("#parent").html(response);
            if (!codeAlreadyRan) {
            //    window.updateButtonText('SFW'); 
                codeAlreadyRan = true;
            }
        },
        error: function(error) {
            console.error("Hiba történt:", error);
        }
    });
});


$(document).ready(function() {
  // Süti értékének betöltése
  var activeButton = getCookie('activeButton');

  // Alapértelmezett gomb aktiválása
  if (activeButton) {
    $('#' + activeButton).addClass('my-active-button');
  } else {
    $('#newButton1').addClass('my-active-button');
  }

  // Rádiógomb-szerű viselkedés
  $('#newButton1, #newButton2').click(function(e) {
    e.preventDefault();
    
    // Mindkét gomb inaktívvá tétele
    $('#newButton1, #newButton2').removeClass('my-active-button');
    
    // Az aktuálisan kattintott gomb aktívvá tétele
    $(this).addClass('my-active-button');
    
    // Süti beállítása
    setCookie('activeButton', $(this).attr('id'), 365);
  
        // Oldal frissítése
        location.reload();
  });
});



  window.onpopstate = function(event) {
  if (event.state && event.state.noAjaxReload) {
    // ne küldd újra az AJAX kérést
   // alert("ez fut");
  } else {
    // küldd újra az AJAX kérést
    loadUserName();
  }
};

function loadUserName() {
  $.ajax({
    url: 'get_user_name.php',
    type: 'get',
    success: function(response){
      $("#user-name").html(response);
      history.pushState({ noAjaxReload: true }, '');
    }
  });
}

loadUserName();
 // oldal betöltődéskor küldd el az AJAX kérést


 var currentImgName;

 var isModalOpen = false;
function loadGaleries(img_name) {
  isModalOpen = true;
    var encoded_img_name = encodeURIComponent(img_name);
    // Tegyük a kép nevét elérhetővé a globális környezetben
    window.current_img_name = img_name;
    currentImgName = img_name; // Új globális változó
    // Ürítsük a modál test tartalmát
    $('#modal-body').empty();
    $.ajax({
        url: 'index.php?modul=galeries&img_name=' + encoded_img_name,
        type: 'GET',
        success: function(response) {
            // Tegyük be a választ a modális testbe
            $('#modal-body').html(response);
            // Majd jelenítsük meg a modált
            $('#myModal2').modal('show');

            // Állapot hozzáadása a böngésző history-jához
            window.history.pushState({ modalOpen: true }, null, null);


        }
    });
}
// A modális bezárásakor
document.getElementById('myModal2').addEventListener('hidden.bs.modal', function(event) {
    isModalOpen = false;
});
window.addEventListener('popstate', function(event) {
    if (isModalOpen) {
     
        location.reload();
    }
});


$(document).ready(function(){
var myModal2El = document.getElementById('myModal2')

myModal2El.addEventListener('hidden.bs.modal', function (event) {
  $('body').css('background-color', 'rgb(44, 46, 51)'); 
  $('.list-group-item').css({
    'background-color': '#2d2e33',
    'color': '#c1c2c5',
    'border-color': '#44454a',
    'padding': '0.5rem 1rem',
    'border-width': '2px',
    'border-radius': '4px !important',
    'background-color': '#2d2e33',
    'text-decoration': 'none',
    'margin': '0 10px !important',
    'height': '35px',
    'border-top-width': '2px !important',
    'display': 'flex !important',
    'align-items': 'center',
    'justify-content': 'center'
  });
  $('.new-buttons-t').css('border-color', 'rgb(44, 46, 51)');
//  alert('on');

  //$('body').focus();

});


console.log($('#largeImageModal'));
});

$(document).ready(function(){
var myModal3El = document.getElementById('largeImageModal')

myModal3El.addEventListener('hidden.bs.modal', function (event) {
  $('body').css('background-color', 'rgb(44, 46, 51)'); 
  $('.list-group-item').css({
    'background-color': '#2d2e33',
    'color': '#c1c2c5',
    'border-color': '#44454a',
    'padding': '0.5rem 1rem',
    'border-width': '2px',
    'border-radius': '4px !important',
    'background-color': '#2d2e33',
    'text-decoration': 'none',
    'margin': '0 10px !important',
    'height': '35px',
    'border-top-width': '2px !important',
    'display': 'flex !important',
    'align-items': 'center',
    'justify-content': 'center'
  });
  $('.new-buttons-t').css('border-color', 'rgb(44, 46, 51)');
//  alert('on');

  //$('body').focus();

});


console.log($('#largeImageModal'));
});


</script>
<script>
$(document).ready(function(){

  ////////////////////////////////////////////////////////////////////
    $("#user-name3").click(function(){
        $.ajax({
            url: 'get_user_models.php', // a PHP script, ami végrehajtja a lekérdezést
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // üríti a modális test tartalmát
                var addNewModelButton = $("#add_new_model").detach();
                $("#myModal .modal-body #model-list").empty();

                // a data tartalmazza a visszaküldött adatokat
                // itt feldolgozhatja az adatokat, pl. hozzáadhatja a modal ablakhoz
                $.each(data, function(i, item) {
                 // feltételezzük, hogy a 'data' egy tömb, melynek elemei objektumok ModelID, Model_Name és Model_Active tulajdonságokkal
                var modelName = item.Model_Name !== '' 
                    ? '<a href="uploadmodel.php?modelID=' + item.ModelID + '">' + item.Model_Name + '</a>' 
                    : '<span class="next-to-model" data-model-id="' + item.ModelID + '">Next to model</span>';
                var modelInfo = "<p>ID: " + item.ModelID + ", Name: " + modelName + ", Active: " + item.Model_Active + "</p>";
                $("#myModal .modal-body #model-list").append(modelInfo);
});

                $('#myModal .modal-body #model-list').append(addNewModelButton);
                
                // megnyitjuk a modal ablakot
                $("#myModal").modal('show');
            },
            error: function(xhr, status, error) {
                // hiba esetén ez a rész fut le
                console.error("Hiba a lekérdezésben: ", error);
            }
        });
    });
});


$(document).ready(function(){
  $("#add_new_model").click(function(event){
    event.preventDefault();
    // Modal megjelenítése
    $("#confirmationModal").modal('show');
  });

  // Megerősítés esetén ajax hívás
  $(document).ready(function() {
    $("#confirmAdd").click(function() {
        var selectedItem = $("#itemSelect").val(); // A kiválasztott elem értékének lekérése

        switch(selectedItem) {
            case "item1":
                // Model hozzáadásának logikája
                $.ajax({
                    url: 'add_model.php',
                    type: 'POST',
                    data: { userHash: userHash },
                    dataType: 'json',
                    success: function(data) {
                        if (data.newModelID) {
                            window.location.href = 'uploadmodel.php?modelID=' + data.newModelID;
                        } else {
                            console.error("Nem sikerült lekérni az új modell ID-ját");
                        }
                        $("#confirmationModal").modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error("Hiba az új modell hozzáadásakor: ", error);
                        $("#confirmationModal").modal('hide');
                    }
                });
                break;
            case "item2":
                // Kép hozzáadásának logikája
                // Itt hajts végre egy AJAX kérést vagy egyéb műveletet a kép hozzáadásához
                console.log("Kép hozzáadása... (implementálandó)");
                window.location.href = 'upload_image.php';
              /*  $.ajax({
                    url: 'upload_image.php',
                    type: 'POST',
                    data: { userHash: userHash },
                    dataType: 'json',
                    success: function(data) {
                        if (data.newModelID) {
                            window.location.href = 'upload_image.php?modelID=' + data.newModelID;
                        } else {
                            console.error("Nem sikerült lekérni az új kép ID-ját");
                        }
                        $("#confirmationModal").modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error("Hiba az új kép hozzáadásakor: ", error);
                        $("#confirmationModal").modal('hide');
                    }
                });
*/

                $("#confirmationModal").modal('hide');
                break;
            case "item3":
                // Videó hozzáadásának logikája
                // Itt hajts végre egy AJAX kérést vagy egyéb műveletet a videó hozzáadásához
                console.log("Videó hozzáadása... (implementálandó)");
                $("#confirmationModal").modal('hide');
                break;
            default:
                console.error("Ismeretlen elem kiválasztva");
        }
    });
});

});  // Itt volt a hiányzó zárójel





$(document).on('click', '.next-to-model', function() {
    var modelId = $(this).data('modelId'); // Lekérjük a model ID-ját
    window.location.href = 'uploadmodel.php?modelID=' + modelId; // Hozzáfűzzük az URL-hez
});


/////////////////////////////////////////////////////////


var originalContent;
    // Az #user-name elemre kattintva a .user-pop-up-window-pop-up menü megjelenik vagy elrejtődik.
    $(document).on('click', '#user-name, #profil_image', function() {
    $(".user-pop-up-window-pop-up").toggle();
    //alert('mukodik');
});
$(document).ready(function() {
    // Az oldal betöltődésekor mentse el az eredeti tartalmat
    if (!$('body').hasClass('content-saved')) {
    originalContent = $('#parent').html();
    $('body').addClass('content-saved');
}



    // A lenyíló menü gombjaira kattintva a #parent divben új tartalmat töltünk be.
    $(".user-pop-up-window-my-models").click(function() {
        $("#parent").load("user-my-models_float.php");
        $("#parent").attr("data-state", "new");
    });

    $(".user-pop-up-window-my-galleries").click(function() {
        $("#parent").load("user-my-galeries_float.php");
        $("#parent").attr("data-state", "new");
    });

    $(".user-pop-up-window-settings").click(function() {
        $("#parent").load("user-settings.php");
        $("#parent").attr("data-state", "new");
    });
    $(".user-pop-up-window-down-models").click(function() {
      $("#parent").load("user-my-down_float.php");
      $("#parent").attr("data-state", "new");
    });
    $(".user-pop-up-window-creators-follow").click(function() {
      $("#parent").load("followed_creator_page_float");
     $("#parent").attr("data-state", "new");
    });
    $(".user-pop-up-window-down-models1").click(function() {
      $("#parent").load("user-bookmark.php");
      $("#parent").attr("data-state", "new");
    });
    $(".user-pop-up-window-log-out").click(function() {
      window.location.href = "logout.php";
    });

    $(".user-pop-up-window-log-out1").click(function() {
     window.open("index.php?modul=reported_elements", '_blank');
    });

    // A dokumentum egyéb részeire kattintva a menüt elrejtjük.
    $(document).click(function(event) {
        if (!$(event.target).closest("#user-name, #profil_image, .user-pop-up-window-pop-up").length) {
            $(".user-pop-up-window-pop-up").hide();
        }
    });


});


$('.container a').on('click', function() {
    var buttonText = $(this).text().trim();
    const state = $("#parent").attr("data-state");
    
    if (state === "new") {//$("#parent").load("parent.php");
      location.href = "index.php?modul=categories&currentCategory=" + encodeURIComponent(buttonText);
     
    } 
});

$(document).ready(function() {
$.getJSON('get_user_image.php', function(response) {
    if (response.imgPath !== null) {
        // Az imgPath értéke a válaszból
        $('.user-settings-image').attr('src', response.imgPath);
        
    }
});
});



function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Az oldal bármely részén történő kattintásra elrejti a menüt
window.onclick = function(event) {
  if (!event.target.matches('.main-gal-icon10')) {
    var dropdowns = document.getElementsByClassName("dropdown-content2");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

document.addEventListener('DOMContentLoaded', function() {
  var dropdownItems = document.querySelectorAll('.sort-option');

  dropdownItems.forEach(function(item) {
    item.addEventListener('click', function(event) {
      var selectedValue = event.target.textContent;
      setCookie('selectedSortOption', selectedValue, 365); // 365 napig tároljuk
      console.log('Kiválasztott rendezési opció:', selectedValue);
    });
  });
});

// Süti beállítása
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
//Jobb egérgombbal megnyitás új oldalon eseménye
var myModal = null;
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var action = urlParams.get('action');
    var imgName = urlParams.get('img_name');

    if(action === 'newPage' && imgName) {
     //   loadGaleries(imgName);
            // Az image_page.php betöltése az AJAX segítségével
            console.log(imgName);
    $.ajax({
        url: 'index.php?modul=image_page',
        type: 'GET',
        data: { 'imgSrc': './img/' +imgName },
        success: function(response) {
            // A válasz beillesztése a modális ablak testébe
            
            $('#largeImageModal .modal-body').html(response);
        }
    });

    if (!myModal) {
        myModal = new bootstrap.Modal(document.getElementById('largeImageModal'));  // Modális ablak létrehozása
    }
    
    myModal.show(); 
        
        // Az URL frissítése az eredeti állapota szerint
       history.replaceState({}, document.title, "./index.php#");
    }
    else if(action === 'newPage2' && imgName) {  // Figyelem: 'else if', nem 'elseif'
        loadGaleries(imgName);
// Az URL frissítése az eredeti állapota szerint
history.replaceState({}, document.title, "./index.php#");
  }
});
/*
document.addEventListener('click', function(event) {
    if (event.target.closest('#narrowbottom_lora2 span')) {
        var selectedValue = event.target.textContent.trim();
        var currentModel = getCookie('selectedModel');

        console.log(selectedValue); // Az aktuálisan kiválasztott elem értéke

        if (currentModel === selectedValue) {
            deleteCookie('selectedModel');
        } else {
            setCookie('selectedModel', selectedValue, 7); // A süti 7 napig érvényes
        }
    }
});
*/


document.addEventListener('DOMContentLoaded', function() {
  //  highlightSelectedModel();

    document.addEventListener('click', function(event) {
        if (event.target.closest('#narrowbottom_lora2 span')) {
            var selectedValue = event.target.textContent.trim();
            var currentModel = getCookie('selectedModel');

            if (currentModel === selectedValue) {
                deleteCookie('selectedModel');
             //   removeHighlightFromAll();
                        // Oldal frissítése
        location.reload();
            } else {
                setCookie('selectedModel', selectedValue, 7); // A süti 7 napig érvényes
           //     highlightSelectedModel();
                        // Oldal frissítése
        location.reload();
            }
        }
    });
});
/*
$(document).ready(function() {
  var currentModel = getCookie('selectedModel');
  console.log(currentModel);
  // highlightSelectedModel();
});
function highlightSelectedModel() {
    var currentModel = getCookie('selectedModel');
    console.log(currentModel);
    removeHighlightFromAll();

    if (currentModel) {
        var selectedElement = document.querySelector('#narrowbottom_lora2 span[id="' + currentModel + '"]');
       // alert(selectedElement);
        if (selectedElement) {
            selectedElement.style.backgroundColor = 'rgb(252, 125, 72)';
        }
    }
}

function removeHighlightFromAll() {
    document.querySelectorAll('#narrowbottom_lora2 span').forEach(function(span) {
        span.style.backgroundColor = '';
    });
}
*/
// Süti beállítása
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Süti értékének lekérése
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

// Süti törlése
function deleteCookie(cname) {
    setCookie(cname, "", -1);
}

// Gombok kiválasztása
var buttons = document.querySelectorAll('.list-group-item');

// Gombokon történő kattintás kezelése
buttons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Megakadályozza az alapértelmezett navigációs viselkedést

        // Eltávolítja a kiemelést az összes gombról
        buttons.forEach(function(btn) {
            btn.style.backgroundColor = '';
        });

        // Kiemeli az aktuálisan kiválasztott gombot
        button.style.backgroundColor = 'rgb(252, 125, 72)';
    });
});

// Kattintás a dokumentumon
document.addEventListener('click', function(event) {
    // Ellenőrzi, hogy a kattintás a gombon belül történt-e
    var isButtonClick = event.target.classList.contains('list-group-item');

    if (!isButtonClick) {
        // Ha nem gombra kattintott, keresi, hogy van-e kiemelt gomb
        var highlightedButton = document.querySelector('.list-group-item[style*="background-color"]');
        if (highlightedButton) {
            // Ha van kiemelt gomb és azon kívülre kattintottak, nem távolítja el a kiemelést
            return;
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
  var categoryCookieValue = getCookie('category'); // A süti értékének lekérése
  var buttons = document.querySelectorAll('.container .list-group-item-action'); // Az összes gomb kiválasztása

  buttons.forEach(function(button) {
    if (button.textContent.trim() === categoryCookieValue) {
      button.style.backgroundColor = 'rgb(252, 125, 72)'; // Ha a gomb szövege egyezik a süti értékével, állítsa be a háttérszínt
    }
  });
});

// Tárolja el a kiemelt gombot


document.getElementById('myModal2').addEventListener('hidden.bs.modal', function(event) {
  setTimeout(function() {
    var categoryCookieValue = getCookie('category');
    var buttons = document.querySelectorAll('.container .list-group-item-action');
    buttons.forEach(function(button) {
      if (button.textContent.trim() === categoryCookieValue) {
        button.style.backgroundColor = 'rgb(252, 125, 72)';
      }
    });
  }, 100); // 100 millisekundum késleltetéslargeImageModal
});
document.getElementById('largeImageModal').addEventListener('hidden.bs.modal', function(event) {
  setTimeout(function() {
    var categoryCookieValue = getCookie('category');
    var buttons = document.querySelectorAll('.container .list-group-item-action');
    buttons.forEach(function(button) {
      if (button.textContent.trim() === categoryCookieValue) {
        button.style.backgroundColor = 'rgb(252, 125, 72)';
      }
    });
  }, 100); // 100 millisekundum késleltetéslargeImageModal
});




</script>

<div id="chat_win"></div>



<script>

//-----CHAT---------------------------------------------------------------
function start_chat() {

  allCleanInterval_mainPage(); 
  removeCircleFromSvg();
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
     
    chatBox = document.getElementById('chatBox');
    if (chatBox){
        closeChatWinState();
    }
  
    $.ajax({
        type: "post",
        url: '/image/chat/load_chatContent_main.php',
        data: {
         // kepId: kepId
        },
        success: function(data_chat_win) {
          //console.log(data_chat_win);
          $('#chat_win').html(data_chat_win);
         
          chatBox = document.getElementById('chatBox');
           if (chatBox){
              closeChatWinState();
            }
  
          
        }
    });
 
  }

  //FONTOS!
  //interval valtozok tisztitasa a tobbi chat ablak megnyitas miatt
  function allCleanInterval_mainPage() {
  
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
 
    if (typeof closeChatWindow === 'function') {
        closeChatWindow();
    }
    if (typeof closeUserSelectWin_main === 'function') {
      closeUserSelectWin_main();
    }  
 
    allCleanInterval_mainPage();
    addRedcircle_toChatButton();
    

  });

//--------------------------------------------------------------------------------------------

//piros pontot adunk a chat-gombhoz
function addRedcircle_toChatButton(){ 
//alert(userHash);

$.ajax({
        type: "post",
        url: '/image/chat/chat_button_red.php',
        data: {
          userHash: userHash
        },
        success: function(data) {
          console.log(data);
          if (data>0){
              addCircleToSvg();  //ha van olvasatlan, akkor piros pontot adunk a gombhoz
          } 
          //alert(data);     
          
        }
    });

}



function addCircleToSvg() {     //piros pont hozzaadasa a fo chat gombhoz
    var svg = document.getElementById('openChat');
    var circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    circle.setAttribute('cx', '710');
    circle.setAttribute('cy', '300');
    circle.setAttribute('r', '170');
    circle.setAttribute('fill', 'red');
    circle.setAttribute('id', 'notificationCircle');

    circle.classList.add('notification-circle');
    svg.appendChild(circle);
}


function removeCircleFromSvg() {      //piros pont levetele a fo chat gombrol
   var svg = document.getElementById('openChat');
   var circle = document.getElementById('notificationCircle'); 
   if (circle) {
       svg.removeChild(circle); 
   } 
  
}


//--------------end:chat-------------------------------------------------------------------------





</script>




</body>

