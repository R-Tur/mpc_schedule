<?
require("auth.php");
$uploaddir = "programms/";
if(isset($_POST["delete"])){ 
  if(isset($_POST["track"])) unlink($uploaddir.$_POST["track"]); 
}
?>
<html>
<body>
<form method="POST" target="">
<select size="3" name="track">
<option value="title" disabled>Your uploaded tracks.</option>
<?
$dir = "programms/";
if(file_exists($dir)){
	$files = scandir($dir);
}

if(isset($files))
for($i=2;$i<count($files);$i++){
echo "<option value=\"".$files[$i]."\">".$files[$i]."</option>";
}
?>
</select>
<a href="upload.php">upload</a>
<br>
<hr>
<br>
<input type="submit" name="submit" value="submit">
<input type="submit" name="delete" value="delete">
</form>
<a href="index.php">home</a>
</body>
</html>

<?php
if(!isset($_POST["submit"]) || !isset($_POST["track"]) || !isset($_GET["d"]) || !isset($_GET["h"]) || !isset($_GET["m"])){
die();
}
$root = "schedule/";
$dirname = "$root{$_GET["d"]}_{$_GET["h"]}_{$_GET["m"]}";
if (!file_exists($root)) {
    mkdir($root, 0777, true);
}
if(!file_exists($root)){
  die("can't create a $root directory. Check the rights.");
}
if(file_exists($dirname)){
 die("directory already exists");
}
if(mkdir($dirname)){
  file_put_contents($dirname."/info",$_POST["track"]);
  $cronstr = $_GET["m"]." ".$_GET["h"]." * * ".$_GET["d"]." ".realpath(dirname(__FILE__))."/"."shell_scripts/play_now.sh "." \"$uploaddir".$_POST["track"]."\""." > /dev/null 2>&1"."\n";
  file_put_contents($dirname."/play.crontab", $cronstr);
  shell_exec ("shell_scripts/cron_update.sh");
  header("location: index.php");
  die();
}


?>