<?php
error_reporting(0);
include('../include/settings.inc.php');
include('../include/lib.inc.php');

setcookie($_POST["nazwa"], $_POST["wartosc"], time()+30*24*3600, "/");

?>
