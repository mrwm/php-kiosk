<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<style>
  .h3{font-size:24px}
    fieldset{
    border: 1px solid black;
    border-radius: 25px;
    margin: 10px;
  }
  form input{
    display: block;
    margin: 3px;
  }
  .center{
    margin-top: 2em;
    margin-right: 30%;
    margin-left: 30%;
  }
  img{
    width:100%;
    margin:10px;
    border: 5px double black;
  }
</style>
<fieldset>
  <form action="upload.php" method="post">
    <p class="center">
      <?php
        $currentDelay = exec("cat variables/delay");
        echo "Current delay:'".$currentDelay."'<br>";
        exec("echo true > variables/reloadMe");
      ?>
      Slideshow delay in seconds: <input type="number" name="seconds" min="0" value="2"><br>
      Slideshow delay in minutes: <input type="number" name="minutes" min="0" value="0"><br>
    <input type="submit">
    </p>
  </form>
</fieldset>
<fieldset>
  <form action="" method="post" enctype="multipart/form-data" accept="image/*">
    <p class="center">
      <span class="h3">Pictures:</span>
      <input type="file" name="pictures[]" />
      <input type="file" name="pictures[]" />
      <input type="file" name="pictures[]" />
      <input type="submit" value="Send" />
    </p>
  </form>
</fieldset>
<fieldset>
  <p class="center">
    <span class="h3">Pictures Stored:</span>
    <?php
      $stored = exec("./storedPics");
      echo $stored;
    ?>
  </p>
</fieldset>
<?php
$seconds = $_POST["seconds"] * 1000; // milliseconds -> seconds
$minutes = $_POST["minutes"] * 6000; // to minutes
$total = $seconds + $minutes;
$file = escapeshellarg($total);
exec("echo $total > /variables/delay");
exec("echo true > variables/reloadMe");

// Uploading
foreach ($_FILES["pictures"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
    // basename() may prevent filesystem traversal attacks;
    // further validation/sanitation of the filename may be appropriate
    $name = basename($_FILES["pictures"]["name"][$key]);
    move_uploaded_file($tmp_name, "$name");
    $file = escapeshellarg($name);
    exec("mv $file ups");
    exec("./rename");
  }
}
// Deleting
if (is_numeric($_GET['deleteMe'])) {
  $delThis = "ups/".$_GET['deleteMe'];
  //echo $delThis;
  $deleteThis = escapeshellarg($delThis);
  $delOut = exec("rm $deleteThis; echo deleted $deleteThis");
  echo $delOut;
  exec("./rename");
  exec("echo true > variables/reloadMe");
}
?>
