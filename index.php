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
html, body {margin:0; height:100vh; overflow: hidden}
img{
  display:inline;
  width:100%; height:100%;
  object-fit: fill;
  position:absolute;
  top:0;
  left:0;
}
</style>
</head>

<body>
<iframe src="reloadCheck.php" id="relCheck" name="relMe"></iframe>

<div style="height:100%">
  <?php
    $out = exec("./storedPics");
    echo $out;
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