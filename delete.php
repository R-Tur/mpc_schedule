<?
require("auth.php");
if(!$_GET["d"] || !$_GET["h"] || !$_GET["m"]){
  die("bad request (check the parameters)");
}
$dir = 'schedule/';
$dirname = "$dir{$_GET["d"]}_{$_GET["h"]}_{$_GET["m"]}";
shell_exec("rm ".$dirname." -R");
shell_exec ("shell_scripts/cron_update.sh");
header("location: index.php");
die();
?>