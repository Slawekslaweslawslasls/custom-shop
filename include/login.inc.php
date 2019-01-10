<?php
include('settings.inc.php');

if(isset($_POST['login']) && isset($_POST['haslo'])){
    //$res = mysqli_query($DB, "select * from admin where email='".$_POST['login']."' and haslo=md5('".$_POST['haslo']."')");
    $res = mysqli_query($DB, "select * from admin where email='".$_POST['login']."'");
    if(mysqli_num_rows($res) > 0){
	$_SESSION['login'] = $_POST['login'];
    }
}

if(!isset($_SESSION['login'])){
    header("Location: http://".$_SERV.$_PATH."/loginform.html");
}
?>