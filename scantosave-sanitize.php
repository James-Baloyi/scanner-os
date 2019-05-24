<?php
include('con.php');
header('Access-Control-Allow-Origin: *');
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Revisit-After" content="1 Days">
<meta name="robots" content="index, follow">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="llqrcode.js"></script>
<script type="text/javascript" src="webqr.js"></script>
  </head>
  <body>
  <div id="mainbody" style="display: inline;">
  <table class="tsel" border="0" width="100%">
  <tbody><tr>
  <td valign="top" align="center" width="50%">
  <img class="selector" id=" webcamimg" src="" onclick="setwebcam()" align="lef" style="opacity: 1;"><img class="selector" id="qrimg" src="./reader_files/cam.png" onclick="setimg()" align="right" style="opacity: 0.2;"><div id="canvas-container">
  <canvas id="qr-canvas" onclick="load();" width="360" height="300" style="width: 100%; height: 100%;" ></canvas>
  <fieldset id='align-code'>
  </fieldset>
<!--
    Lot Number-Sliding Tray
-->
<script>
function getAgent(){
    var pos = navigator.userAgent;
    return pos;
}

if (window.matchMedia('(display-mode: standalone)').matches){
    sendRequest('PWA');
}

window.onbeforeunload = function(event){
     var evt = event+' reason = reload'
     sendRequest(evt);
}

function sendRequest(event){
    var xhr = new XMLHttpRequest();
    var url = 'send-email.php?ev='+event;
    xhr.open('GET', url, false);
    xhr.send();
    console.log(event);
}
</script>

  </div><div id="button-container">
      <button id='scan' onclick='load()'>Start Scanning</button>
  </div><div id="outdiv"><video id="v" autoplay="true" onclick="load();"></video></div><div id="result"><br><div id="load-container"><div class="pre-loader"></div></div></div><div id="search-results">
  </div><table class="tsel" border="0">
  <tbody><tr>
  <style>
  #align-code{
    width: 50%;
    height: 200px;
    border: 2px #900 dashed;
    position: absolute;
    top: 85px;
    left: 23%;
    background: rgba(0, 0, 0, .02);
    box-shadow: 0px 0px 100px 0px rgba(0, 0, 0, .15);
  }
  .pre-loader{
      width: 100px;
      height: 10px;
      margin-top: -5px;
      background: #159;
      border-radius: 4px;
      animation-name: load;
      animation-duration: 2s;
      animation-iteration-count: 1000;
      transition: 1s;
      position: absolute;
  }
  #load-container{
      background: rgba(0, 0, 0, .1);
      padding: 5px;
      margin-top: 10px;
  }
  @keyframes load{
    0% {
      left: 0;
    }
    50% {
      left: 72%;
    }
    100% {
      left: 0;
    }
  }
  #button-container{
      width: 100%;
      padding: 0px;
      position: relative;
      background: #fff;
  }
  #button-container button{
      width: 100%;
      height: 45px;
      background: rgb(0, 32, 96);
      color: #fff;
      border: 0px;
      font-weight: 600;
  }
  img[id='webcamimg']{
      visibility: hidden;
      width: 0px;
  }
  img[id='qrimg']{
      visibility: hidden;
      width: 0px;
  }
  body{
      padding: 0px;
      margin: 0px;
      width: 100%;
      height: 100%;
      overflow-x: hidden;
      font-family: Arial, sans-serif;
  }
  video[id='v']{
      width: 0px;
      visibility: hidden;
  }
  #canvas-container{
      width: 100%;
      height: 360px;
      border-radius: 0px;
      position: relative;
      background: #000;
      margin: 0px;
      padding-bottom: 0px;
  }
  #search-results{
      margin-top: 30px;
      background: #fff;
  }
  a{
    color: rgb(0, 32, 96);
  }
  #submit{
    width: 90%;
    height: 40px;
    background: rgb(0, 32, 96);
    border: 0px;
    color: #fff;
    font-size: .9em;
    border-radius: 2px;
  }
  input, select{
    width: 80%;
    height: 40px;
    border: 0px #999 solid;
    padding: 10px;
    border-radius: 0px;
    font-size: .9em;
    background: #f2f2f2;
    color: #333;
    margin-top: 15px;
  }
  #log_num{
    padding: 5px;
    border-radius: 2px;
    width: 90%;
  }
  .mrx{
      width: 40%;
  }
  </style><br>
  <div id='log_num'>

<button class='bring-tray' onclick='toggleTray(event); doRotate()'>
&larr;
</button>
<br>
<div class='sliding-tray'> 
  <input style='opacity: 0; height: 1px; visibility: hidden; padding: 0px;' type='text' name='log_num' id='log_text' placeholder='Log Number' value=''><br>
  
  <input type='text' name='reg' id='reg' placeholder='POD Number'><br>
  <select type='text' id='supplier' onchange='setSpecies(this.value)'>
      <option value=''>Supplier</option>
    <option value='SUP1'>SUP1</option>
        <option value='SUP2'>SUP2</option>
        <option value='SUP3'>SUP3</option>
        </select>
<span id='selectParent'>
<input type='text' id='species' disabled>
</span>

<select type='text' id='color' onchange='changeBorder(this.value)'>
<option value=''>Tag Colour</option>
<option value='purple'>Purple</option>
<option value='navy'>Dark Blue</option>
<option value='blue'>Half White / Blue</option>
<option value='red'>Red</option>
<option value='#0073cb'>Light Blue</option>
<option value='#008800'>Green</option>
<option value='#002fff'>White</option>
<option value='pink'>Pink</option>
</select><br>

  <input type='text' id='regis' placeholder='Registration'><br>
  <input type='text' id='lot-no' placeholder='Lot Number' style='width: 40%'> <input type='text' id='bay-no' placeholder='Bay Number' style='width: 40%'> 
<br>
</div>

<script>
function setSpecies(supplier){
    if(supplier.indexOf('ingisi') > -1){
        var parentS = document.querySelector('#selectParent');
        parentS.innerHTML = '';
        var select = document.createElement( 'select' );
        parentS.appendChild(select);
        select.setAttribute('onchange', 'altForm(this.value)');
        select.setAttribute('id', 'species');
        var option;
        var inputdata = 'Cedar||Blackwood';
        inputdata.split( '||' ).forEach(function( item ){
        option = document.createElement('option');
        option.value = option.textContent = item;
        select.appendChild(option);
    });   
    }else if(supplier.indexOf('erensky') > -1){
        var parentS = document.querySelector('#selectParent');
        parentS.innerHTML = '';
        var select = document.createElement( 'select' );
        parentS.appendChild(select);
        select.setAttribute('onchange', 'altForm(this.value)');
        select.setAttribute('id', 'species');
        var option;
        var inputdata = 'Pine';
        inputdata.split('||').forEach(function( item ) {
        option = document.createElement('option');
        option.value = option.textContent = item;
        select.appendChild(option);
    });
    }else
    if(supplier.indexOf('nusu') > -1){
        var parentS = document.querySelector('#selectParent');
        parentS.innerHTML = '';
        var select = document.createElement( 'select' );
        parentS.appendChild(select);
        select.setAttribute('onchange', 'altForm(this.value)');
        select.setAttribute('id', 'species');
        var option;
        var inputdata = 'Grandis';
        inputdata.split('||').forEach(function( item ) {
        option = document.createElement('option');
        option.value = option.textContent = item;
        select.appendChild(option);
    });
    }
}
function changeBorder(colour){
    document.querySelector('#color').style.borderTop = `${colour} 5px solid`;
}
function toggleTray(event){
    var murrent = window.getComputedStyle(event.target, null);
    var current = parseFloat(murrent.getPropertyValue('transform'));
    var newR = parseInt(180);
    event.target.style.transform = `${current}+${newR}`;
    var tray = document.querySelector('.sliding-tray');
    tray.classList.toggle('hidden');
}
</script>
<style>
.sliding-tray{
    width: 100%;
    background: #fff;
    border: 0px #999 solid;
    padding: 0px;
    margin: 0px;
    opacity: 1;
    transition: .2s;
}
.hidden{
    opacity: 0;
    position: absolute;
    margin-top: -10000px;
    transition: .3s;
}
.bring-tray{
      width: 40px;
      height: 40px;
      opacity: .7;
      background: rgb(0, 32, 96);
      color: #fff;
      border: 0px;
      font-weight: 600;
      left: 0px;
      position: absolute;
      transition: .2s;
}
div[id='search']{
    position: fixed;
    bottom: 0px;
    padding: 5px;
    width: 100%;
}
#seeHistory{
    position: fixed;
    bottom: 0px;
    margin: 0px;
    background: #f2f2f2;
    color: #333;
    width: 100%;
    height: 35px;
    border: 0px;
    margin-left: -50%;
}
</style>
<select type='text' id='trimmed'>
  <option value=''>Trimmed Length</option>
 <option value='2.8'>2.9m</option>
<option value='3'>3.1m</option>
  <option value='3.8'>3.9m</option>
  <option value='5.8'>5.9m</option>
</select>
  <br>
  <input type='number'  maxlength='2' name='width' class='mrx' id='width' placeholder='SED 1'>
  <input type='number' maxlength='2'  name='height' class='mrx' id='height' placeholder='SED 2'>
  
  <section id='leds' style='opacity: 0; visibility: hidden;'>
      <input type='number' maxlength='2' name='width' class='mrx' id='width1' placeholder='LED 1'>
      <input type='number' maxlength='2' name='height' class='mrx' id='height1' placeholder='LED 2'>
    </section>
  </div><br>
<div id='search'>
<div id='res'></div>

<div id='closedForm' style='position: fixed; bottom: -9000px; width: 50px; max-height; 150px; transition: .3s; opacity: 0'>
<input type='text' id='lot_number_dah' placeholder='Type in Slot Number to Close' maxlength='3' style='text-align: center; width: 50%'><br><br>
<button id='confirm' onclick='checkSlot()'>Confirm Closure</button>
</div>
<!--
    <input list="find">
<datalist id="find">
    <?/*
    $q1 = mysqli_query($con, "SELECT * FROM blank_codes");
    while($row = mysqli_fetch_array($q1, MYSQLI_ASSOC)){
    $result = $row['log_number'];
    echo "<option value='$result'>";
    }
    */?> 
    <button id='go' onclick='getResult()' style='width: 30px; height: 30px; background: #f2f2f2; color: #333; border: 1px #999 solid;'>Go</button>                                                                   
</datalist>
-->
</div>
<div id='historyTab'>

</div>
<style>
#closedForm{
    width: 100%;
    position: fixed;
    top: 160px;
    background: #fff;
    margin-left: 5%;
    padding: 10px;
    opacity: 0;
    box-shadow: 0px 15px 15px 0px rgba(0, 0, 0, .15);
}
button[id='confirm']{
    width: 50%;
    height: 35px;
    background: rgb(0, 32, 96);
    color: #fff;
    font-size: .9em;
    border: 0px;
    margin: 5px;
}
</style> 


<script>

function closeLoad(){
    var formBox = document.querySelector('#closedForm');
    formBox.style.width = '100%';
    formBox.style.padding = '0px';
    formBox.style.paddingTop = '10px';
    formBox.style.paddingBottom = '10px';
    formBox.style.top = '130px';
    formBox.style.opacity = '1';
    formBox.style.height = '150px';
    formBox.style.marginLeft = '-10px';
  }

function checkSlot(){
    var ln1 = document.querySelector('#lot_number_dah').value;
    var ln2 = document.querySelector('#lot-no').value;
    if(ln1 == ln2){
    var pod = document.querySelector('#reg').value;
    //confirmSeal(ln2, pod);
    }else{
    document.querySelector('#closedForm').innerHTML = '<b style="color: red; font-size: 1.2em;">Incorrect Lot Number!</b>';
    location.reload();
    }
}

function confirmSeal(ln, pod){
    var url = 'confirm-seal.php?ln='+ln+'&pod='+pod;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, false);
    xhr.onreadystatechange = () => {
        if(xhr.status == '200' && xhr.readystate == '4'){
            var resp = xhr.responseText;
            console.log(resp);
        }
    }
    xhr.send();
}
function getResult(){
    alert('400: Status error');
}
  function altForm(species){
    if(species.indexOf('lackwood') > -1 || species.indexOf('edar') > -1){
      document.querySelector('#leds').style.opacity = '1';
      document.querySelector('#leds').style.visibility = 'visible';
    }else{
      document.querySelector('#leds').style.opacity = '0';
      document.querySelector('#leds').style.visibility = 'hidden';
    }
  }

function brackets(str) {
  var results = [], re = /(([^)]+))/g, text;
  while(text = re.exec(str)) {
  results.push(text[1]);
  }
  return results;
}

  function doAlert(a){
    var ua = navigator.userAgent;
    var pos = brackets(ua)[0];
    console.log(pos);
    var xhr = new XMLHttpRequest();
    //Get a corresponding key to the QR Code
    xhr.open('GET', 'https://example.co.za/qrcode/matchcode.php?code='+a, false);
    xhr.send();
    var respV = xhr.responseText;
    var respX = respV.replace(/\s/g,'');
    //createHistory(respX);
    document.querySelector('#log_text').value = respX;
    var x = document.querySelector('#log_text');
    var t_ref = document.querySelector('#reg').value;
    var sed1 = document.querySelector('#width').value;
    var sed2 = document.querySelector('#height').value;
    var led1 = document.querySelector('#width1').value;
    var led2 = document.querySelector('#height1').value;
    var regis = document.querySelector('#regis').value;
    var lot = document.querySelector('#lot-no').value;
    var bay = document.querySelector('#bay-no').value;
    var trimmed = document.querySelector('#trimmed').value;
    var color = document.querySelector('#color').value;
    var species = document.querySelector('#species').value;
    var result = document.querySelector('#result');
    //console.log('100');
    var xhttp = new XMLHttpRequest();
    console.table(t_ref, sed1, sed2, led1, led2, regis, lot, trimmed, color, species);
    xhttp.open('GET', 'https://example.co.za/qrcode/blank.php?qr='+a+'&log='+respX+'&ref='+t_ref+'&sed1='+sed1+'&sed2='+sed2+'&led1='+led1+'&led2='+led2+'&regis='+regis+'&lot='+lot+'&color='+color+'&trimmed='+trimmed+'&species='+species+'&bay='+bay+'&pos='+pos, false);
    xhttp.send();
    document.querySelector('#width').value = '';
    document.querySelector('#height').value = '';
    document.querySelector('#width1').value = '';
    document.querySelector('#height1').value = '';
    var resp = xhttp.responseText;
    if(resp.indexOf('saved') < 0){
    navigator.vibrate([255, 100, 255]);
  }
    result.innerHTML = `<b>${resp}</b>`;
    alert(resp + ' scanned');
  }
  function boxColour(b){
    if(parseInt(b) > 2){
      var box = document.querySelector('#align-code');
      box.style.border = '#292 1px solid';
      //alert('Successfully Saved...');
      
    }else if(parseInt(b) > 4){
      var box = document.querySelector('#align-code');
      box.style.border = '#090 1px ';
      //alert('Successfully Saved...');
    }
  }
  
  /*
  var historyObj = new Array();
  function createHistory(h){
    if(historyObj.length > 15){
        historyObj = [];
        historyObj.push(h);
    }
    console.log(historyObj);
  }
  function seeHistory(){
      var y = historyObj.length;
      var x;
      for(x = 0; x < y; x++){
        var fs = document.createElement('fieldset', 'fieldset');
        fs.setAttribute('id', 'historySpan');
        fs.innerHTML = historyObj[x];
        var ht = document.querySelector('#historyTab');
        ht.appendChild(fs);
      }
  }
*/
  </script>
  <style>

#alertBox{
    width: 100%;
    position: fixed;
    top: 130px;
    background: #fff;
    margin-left: 0%;
    padding: 0px;
    max-height: 150px;
    margin-left: -20px;
}
#historyTab{
    width: 90%;
    margin: 0px;
    padding: 0px;
    position: fixed;
    margin-top: 20px;
}
  </style>
  </tr></tbody></table></td></tr></tbody></table></div></body></html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  