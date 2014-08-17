<?require("auth.php");?>
<html>
<body>
<form enctype="multipart/form-data" method="POST">
	<input name="userfile" type="file" />
	<input type="hidden" name="ref" value="<?=$_SERVER["HTTP_REFERER"];?>" />
    <input type="submit" value="Send File" />
</form>
</body>
</html>

<?php
$uploaddir = 'programms/';
if (!file_exists($uploaddir)) {
    mkdir($uploaddir, 0777, true);
}
if(!file_exists($uploaddir)){
  die("can't create a $uploaddir directory. Check rights.");
}
if(!$_FILES['userfile']['name']){
die("There is no file for upload!");
}
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	if($_POST["ref"]){
	  header("location: ".$_POST["ref"]);
	  die();
	}
}
?>