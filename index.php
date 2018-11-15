<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">-->
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<style>
.mySlides {display:none;}
html, body {margin:0; height:100vh; overflow: hidden; background: #000;}
img{
  display:inline;
  width:100%; height:100%;
  position:absolute;
  top:0;
  left:0;
  object-fit: contain;

  /*object-fit: fill; Fills up all area regardless of ratio */
  /*object-fit: cover; Ratio stays, pic is cropped if too large */
  /*object-fit: contain; Ratio stays both up/down, no cropping */
  /*object-fit: scale-down; Same as above, but doesn't scale up if area is larger */
  /*object-fit: none; Stays image size and crops */
  }
</style>
</head>

<body>
<iframe height="0px" width="0px" src="reloadCheck.php" id="relCheck" name="relMe" style="margin:-1px; border: 0px"></iframe>

<div style="height:100%; color:#fff;">
  <?php
    $out = exec("./storedPics");
    echo $out;

    // Message for IP address
    $ip_addr = exec("hostname -I");
    $message_0 = "Local IP address: " . $ip_addr;
    $message_1 = "Upload pictures at: " . $ip_addr . "/upload.php";
    // Uncomment below to show ip address
    //echo $message_0 . "<br>" . $message_1;
    
  ?>
</div>

<script>
var myIndex = 0;
carousel();

function carousel(){
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  var delay = <?php $delay = exec("cat variables/delay"); echo $delay ?>;
  if (delay != 0){
    setTimeout(carousel, delay); // Change image every X seconds
  }
}

reloadCheck();
function reloadCheck(){
  setTimeout(reloadCheck, 2000); // Reload image every 2 seconds
  //document.getElementById('relCheck').contentWindow.location.reload();
  //document.getElementById('relCheck').src = document.getElementById('relCheck').src;
  window.frames['relMe'].location.reload(true);
}
</script>
</body>
</html>