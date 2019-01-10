<?php
error_reporting(0);
include('../include/settings.inc.php');
include('../include/lib.inc.php');

$wybrana_plec = $_POST['wybrana_plec']; 
$wybrany_rodzaj_koszulki = $_POST['wybrany_rodzaj_koszulki'];
$wybrany_rozmiar = $_POST['wybrany_rozmiar'];
$wybrany_kolor = $_POST['wybrany_kolor'];

$res = mysqli_query($DB, "select id from towar t where t.kolor_id=".$wybrany_kolor." and t.rodzaj_koszulki_id=".$wybrany_rodzaj_koszulki." and t.rozmiar_id=".$wybrany_rozmiar." and t.typ_towaru_id=1 and t.plec='".$wybrana_plec."' and dostepny=1");
$wiersz = mysqli_fetch_array($res);
$towar_id = $wiersz['id'];

mysqli_query($DB, "update marketing set koszulka=".$towar_id." where email='".$_SESSION['email']."'");
//var_dump("update marketing set koszulka=".$towar_id." where email='".$_SESSION['email']."'");

setcookie("typ", $wybrany_rodzaj_koszulki, time()+60*60*24*30, "/");
setcookie("kolor", $wybrany_kolor, time()+60*60*24*30, "/");
setcookie("plec", $wybrana_plec, time()+60*60*24*30, "/");
setcookie("rozmiar", $wybrany_rozmiar, time()+60*60*24*30, "/");

$_SESSION['typ'] = $wybrany_rodzaj_koszulki;
$_SESSION['kolor'] = $wybrany_kolor;
$_SESSION['plec'] = $wybrana_plec;
$_SESSION['rozmiar'] = $wybrany_rozmiar;

?>
