<?php
error_reporting(0);
include('../include/settings.inc.php');
include('../include/lib.inc.php');

$email = $_POST['email'];

setcookie("ciastkon", 1, time()+30*24*3600, "/");

$query = "insert into newsletter (email) values('".$email."');";
if(mysqli_query($DB, $query)){
	echo "ok";
}
?>