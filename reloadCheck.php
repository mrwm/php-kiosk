<html>
<script>
var reloadMe = <?php $reloadMe = exec("cat variables/reloadMe"); echo $reloadMe ?>;
console.log(reloadMe);
if (reloadMe){
  console.log("I'm reloading");
  <?php
    exec("echo false > variables/reloadMe");
    // Yeah, dangrous. I know...
    //echo exec("sudo ./rm-cache");
 ?>
  window.parent.location.reload(true); // reloads parent
  window.top.location.reload(true); // reloads top
  window.location.reload(true); // reloads current
  console.log("reloaded?");
}

</script>
<body>
</body>
</html>