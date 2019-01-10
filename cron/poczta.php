<?php
error_reporting(E_ALL | E_STRICT);
require_once './lvadshirt.com/cron/PolishPostTracking/Autoloder.php';
include('./lvadshirt.com/www/include/lib.inc.php');
include('./lvadshirt.com/www/include/config.inc.php');
$DB = mysqli_connect($_DBHOST,$_DBUSER,$_DBPASS);
mysqli_select_db($DB, $_DBNAME);
mysqli_set_charset($DB,"utf8");

$PolishPostApi   = new \PolishPostTracking\Api;

$query = "select id, nr_przesylki from zamowienie where dostawa=0 and nr_przesylki like 'CP%'";
$res = mysqli_query($DB, $query);
while($wiersz = mysqli_fetch_array($res)){
    print $wiersz['nr_przesylki']."\n";
    $packageTracking = serialize($PolishPostApi->checkPackage($wiersz['nr_przesylki']));
    if(strstr($packageTracking, 'Doręczenie')){
	mysqli_query($DB, 'update zamowienie set dostawa=1 where id='.$wiersz['id']);
    }
}





?>