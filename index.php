<?
require("auth.php");
$schedule_list = scandir("schedule/");
?>
<html>
<body>
<table border=1>
<tr>
<td width="100">TIME</td>
<td width="100">MO</td>
<td width="100">TU</td>
<td width="100">WE</td>
<td width="100">TH</td>
<td width="100">FR</td>
<td width="100">SA</td>
<td width="100">SU</td>
</tr>
<?
for($i=0;$i<48;$i++){
?>
<tr>
<?
for($j=0;$j<8;$j++){
if($j==0){
?>
<td><?=date('H:i', mktime(0,$i*30));?></td>
<?
}
else{
$t = $j."_".date('H_i', mktime(0,$i*30));
$h = date('H', mktime(0,$i*30));
$m = date('i', mktime(0,$i*30));
if(in_array($t, $schedule_list)){
$info = file_get_contents("schedule/".$t."/info");
?>
<td><a href="delete.php?d=<?=$j?>&h=<?=$h?>&m=<?=$m?>"><?=$info?></a></td>
<?
}
else{
?>
<?

?>
<td><a href="create.php?d=<?=$j?>&h=<?=$h?>&m=<?=$m?>">&nbsp&nbsp&nbsp</a></td>
<?
}}}
?>
</tr>
<?
}
?>
</table>
<pre>
<?
echo shell_exec ("crontab -l");
?>
</pre>
</body>
</html>
