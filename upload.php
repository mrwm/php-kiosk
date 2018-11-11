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
  <form action="" method="post" enctype="multipart/form-data">
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
<!-- Image submission php below -->
<?php
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
  $out = exec("rm $deleteThis; echo deleted $deleteThis");
  echo $out;
  exec("./rename");
  exec("echo true > variables/reloadMe");
}
?>
