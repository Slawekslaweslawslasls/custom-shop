<?php
error_reporting(E_ERROR | E_PARSE);
include('config.inc.php');
session_start();
$DB = mysqli_connect($_DBHOST,$_DBUSER,$_DBPASS);
mysqli_select_db($DB, $_DBNAME);
mysqli_set_charset($DB,"utf8");

if (mysqli_connect_errno())
  {
    echo "Failed to connect to database";
    exit();
  }

if(isset($_GET['t'])){
	$_SESSION['wybrany_rodzaj_koszulki'] = $_GET['t'];
}else{
	if(isset($_COOKIE['typ'])){
		$_SESSION['wybrany_rodzaj_koszulki'] = $_COOKIE['typ'];
	}	
}
$res = mysqli_query($DB, "select count(*) from dict_rodzaj_koszulki where id=".$_SESSION['wybrany_rodzaj_koszulki']);
if(!$res || mysqli_num_rows($res) == 0){
	unset($_SESSION['wybrany_rodzaj_koszulki']);
} 

if(isset($_GET['k']) && $_GET['k'] > 0){
	$_SESSION['wybrany_kolor'] = $_GET['k'];
}else{
	if(isset($_COOKIE['kolor'])){
		$_SESSION['wybrany_kolor'] = $_COOKIE['kolor'];
	}
}
$res = mysqli_query($DB, "select count(*) from dict_kolor where id=".$_SESSION['wybrany_kolor']);
if(!$res || mysqli_num_rows($res) == 0){
	unset($_SESSION['wybrany_rodzaj_kolor']);
} 


if(isset($_GET['p'])){
	$_SESSION['wybrana_plec'] = $_GET['p'];
}else{
	if(isset($_COOKIE['plec'])){
		$_SESSION['wybrana_plec'] = $_COOKIE['plec'];
	}
}
if($_SESSION['wybrana_plec'] != 'k' && $_SESSION['wybrana_plec']!='m'){
	unset($_SESSION['wybrana_plec']);
}
	
if(isset($_GET['r'])){
	$_SESSION['wybrany_rozmiar'] = $_GET['r'];
}else{
	if(isset($_COOKIE['rozmiar'])){
		$_SESSION['wybrany_rozmiar'] = $_COOKIE['rozmiar'];
	}
}
$res = mysqli_query($DB, "select count(*) from dict_rozmiar where id=".$_SESSION['wybrany_rozmiar']);
if(!$res || mysqli_num_rows($res) == 0){
	unset($_SESSION['wybrany_rozmiar']);
} 


if($_COOKIE['c'] != ''){$_SESSION['c']=$_COOKIE['c'];}
if($_COOKIE['e'] != ''){$_SESSION['e']=$_COOKIE['e'];}
if($_COOKIE['r'] != ''){$_SESSION['HTTP_REFERER']=$_COOKIE['HTTP_REFERER'];}
if($_SESSION['c'] == '' && $_GET['c'] != ''){$_SESSION['c']=$_GET['c']; setcookie("c", $_SESSION['c'], time()+60*60*24*30, "/");}
if($_SESSION['e'] == '' && $_GET['e'] != ''){$_SESSION['e']=$_GET['e']; setcookie("k", $_SESSION['e'], time()+60*60*24*30, "/");}
if($_SESSION['HTTP_REFERER'] == '' && $_SERVER['HTTP_REFERER'] != ''){$_SESSION['HTTP_REFERER']=$_SERVER['HTTP_REFERER']; setcookie("h", $_SESSION['HTTP_REFERER'], time()+60*60*24*30, "/");}
if(is_numeric($_GET['l']) && (int) $_GET['l'] == $_GET['l'] && $_GET['l'] < 1){$lead=$_GET['l'];}else{$lead=1;}

//$_SERVER['HTTP_ACCEPT_LANGUAGE']='sk-SK,en-US;q=0.9';
//$_SERVER['HTTP_CF_IPCOUNTRY']='SK';

//$bufor = "DATA: ".date("d-m-Y H:i:s").", IP: ".$_SERVER['REMOTE_ADDR']."\n";
//$bufor .= "JEZYK:\n";
//$bufor .= '$_GET[\'lang\']: '.$_GET['lang'].'|';
//$bufor .= '$_COOKIE[\'language\']: '.$_COOKIE['language'].'|';
//$bufor .= '$_SERVER[\'HTTP_ACCEPT_LANGUAGE\']: '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'|';
//$bufor .= '$_SERVER[\'HTTP_CF_IPCOUNTRY\']: '.$_SERVER['HTTP_CF_IPCOUNTRY'].'|';
//$bufor .= "\n";
$jestlang = false;
if(isset($_GET['lang'])){
    $lang = $_GET['lang'];
    $jestlang = true;
//$bufor .= "GET\n";
}
if((!$jestlang) && isset($_COOKIE['language'])){
    $lang = $_COOKIE['language'];
    $jestlang = true;
//$bufor .= "COOKIE\n";	
}

if((!$jestlang) && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
    $jezyki_przegl = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
    foreach($jezyki_przegl as $jezyk_przegl){
		list($j_przegl, $par_q) = explode(';',$jezyk_przegl);
		if($par_q == '' || trim($par_q)=='q=1.0'){
			$res = mysqli_query($DB, "select j.skrot, hal.kraj_id from dict_jezyk j, http_accept_language hal where j.id=hal.jezyk_id and hal.przegladarka='".$j_przegl."'");
			if(mysqli_num_rows($res) > 0){
				$wiersz = mysqli_fetch_array($res);
				$lang = $wiersz['skrot'];
				$jezyk_geo = $_SERVER['HTTP_CF_IPCOUNTRY'];
				$res2 = mysqli_query($DB, "select * from dict_kraj k where k.kod='".$jezyk_geo."' and k.id in (select k.id from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."')");
				if(mysqli_num_rows($res2) > 0){
					$jestlang = true;
//$bufor .= "ACCEPT ".$j_przegl." ".$lang."\n";			
					break;					
				}
			}
		}
	}
}

if((!$jestlang) && $jezyk_geo = $_SERVER['HTTP_CF_IPCOUNTRY']){
	$res = mysqli_query($DB, "select j.skrot, k.id from dict_jezyk j, dict_kraj k where j.id=k.jezyk_id and k.kod='".$jezyk_geo."'");
	if(mysqli_num_rows($res) > 0){
		$wiersz = mysqli_fetch_array($res);
		$lang = $wiersz['skrot'];
		$jestlang = true;
//$bufor .= "IP ".$jezyk_geo." ".$lang."\n";
	}
}
if(!$jestlang){
    $lang = 'en';
//$bufor .= "EN\n";	
}

// kraj wysylki
//$bufor .= "KRAJ WYSYLKI:\n";
//$bufor .= '$_SESSION[\'wysylka_kraj\']='.$_SESSION['wysylka_kraj']."\n";	
//$bufor .= '$_COOKIE[\'wysylka\']='.$_COOKIE['wysylka']."\n";	

$jestkraj = false;

if(!$jestkraj && isset($_SESSION['wysylka_kraj'])){
	$dom_kraj_wysylki = $_SESSION['wysylka_kraj'];
	$jestkraj = true;
//$bufor .= "SESSION\n";	
}

if($jestkraj){
	$res = mysqli_query($DB, "select * from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."' and k.id=".$dom_kraj_wysylki);

	if(mysqli_num_rows($res) == 0){
		$jestkraj = false;
//$bufor .= "anulowane\n";
	}
}

if(!$jestkraj && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
    $jezyki_przegl = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	foreach($jezyki_przegl as $jezyk_przegl){
		list($j_przegl, $par_q) = explode(';',$jezyk_przegl);
		if($par_q == '' || trim($par_q)=='q=1.0'){
			$res = mysqli_query($DB, "select hal.kraj_id from http_accept_language hal where hal.przegladarka='".$j_przegl."'");
			if(mysqli_num_rows($res) > 0){
				$wiersz = mysqli_fetch_array($res);
				$dom_kraj_wysylki = $wiersz['kraj_id'];
				$jestkraj = true;
//$bufor .= "ACCEPT=".$jezyk_przegl." ".$dom_kraj_wysylki."\n";
				break;
			}
		}
	}
	
}

if($jestkraj){
	$res = mysqli_query($DB, "select * from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."' and k.id=".$dom_kraj_wysylki);
	if(mysqli_num_rows($res) == 0){
		$jestkraj = false;
//$bufor .= "anulowane\n";		
	}
}

if((!$jestkraj) && $jezyk_geo = $_SERVER['HTTP_CF_IPCOUNTRY']){
	$res = mysqli_query($DB, "select k.id from dict_kraj k where k.kod='".$jezyk_geo."'");
	if(mysqli_num_rows($res) > 0){
		$wiersz = mysqli_fetch_array($res);
		$dom_kraj_wysylki = $wiersz['id'];
		$jestkraj = true;
//$bufor .= "IP=".$jezyk_geo." ".$dom_kraj_wysylki."\n";
	}
}

if($jestkraj){
	$res = mysqli_query($DB, "select * from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."' and k.id=".$dom_kraj_wysylki);
	if(mysqli_num_rows($res) == 0){
		$jestkraj = false;
//$bufor .= "anulowane\n";		
	}
}

if(!$jestkraj && isset($_COOKIE['wysylka'])){
	$dom_kraj_wysylki = $_COOKIE['wysylka'];
	$jestkraj = true;
//$bufor .= "COOKIE\n";
}

if($jestkraj){
	$res = mysqli_query($DB, "select * from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."' and k.id=".$dom_kraj_wysylki);;
	if(mysqli_num_rows($res) == 0){
		$jestkraj = false;
//$bufor .= "anulowane\n";		
	}
}

if(!$jestkraj){
	$res = mysqli_query($DB, "select j.kraj_domyslny_id from dict_jezyk j where j.skrot='".$lang."'");
	$wiersz = mysqli_fetch_array($res);
	$dom_kraj_wysylki = $wiersz['kraj_domyslny_id'];	
//$bufor .= "domyslny\n";	
}
//var_dump($bufor);
$tlumaczenie=file_get_contents($_LANG_PATH.'/locales/'.$lang.'/translation.json');
$txt=json_decode($tlumaczenie);

setcookie("language", $lang, time()+60*60*24*30, "/");
setcookie("wysylka", $dom_kraj_wysylki, time()+60*60*24*30, "/");

//var_dump($dom_kraj_wysylki);

if(!isset($_SESSION['koszyk'])){
    $_SESSION['koszyk'] = array();
    $_SESSION['ilosc'] = 0;
    $_SESSION['kod'] = 0;
    $_SESSION['kod_nr'] = 'Wpisz kod';
    $_SESSION['kod_rodzaj'] = 'k';
    $_SESSION['kod_rabat'] = 0;  
	$_SESSION['kod_hurt'] = 0;
	$_SESSION['kod_hurt_typ'] = 0;
	$_SESSION['kod_hurt_ilosc'] = 0;	
    $_SESSION['etap'] = 0;
    $_SESSION['id_zam'] = 0;
}
$_SESSION['wysylka_kraj'] = $dom_kraj_wysylki;

$res = mysqli_query($DB, "select j.servicemail, j.id, j.symbol, j.pozycja_symbolu, j.waluta from dict_jezyk j where j.skrot='".$lang."'");
$wiersz = mysqli_fetch_array($res);

$jezyk_id = $wiersz['id'];
$waluta = $wiersz['symbol'];
$waluta_pp = $wiersz['waluta'];
$pozycja_symbolu = $wiersz['pozycja_symbolu'];

$customerservicemail = $wiersz['servicemail'];

$strona = basename($_SERVER['PHP_SELF']);
$strona = substr($strona, 0, strrpos($strona, '.')).'.php';

$res_hp1 = mysqli_query($DB, "select title, keywords, description from html_properties where lang=".$jezyk_id." and page='".$strona."'");

if(mysqli_num_rows($res_hp1) == 0){
    $res_hp2 = mysqli_query($DB, "select title, keywords, description from html_properties where lang=".$jezyk_id." and page='*'");
    $wiersz_hp = mysqli_fetch_array($res_hp2);
}else{
    $wiersz_hp = mysqli_fetch_array($res_hp1);

}

$title = $wiersz_hp['title'];
$keywords = $wiersz_hp['keywords'];
$description = $wiersz_hp['description'];

if($_SESSION['id_zam'] != 0){
	$resmark = mysqli_query($DB, "select email_zam from zamowienie where id=".$_SESSION['id_zam']);
	$wierszmark = mysqli_fetch_array($resmark);
	$_SESSION['email'] = $wierszmark['email_zam'];
}

//$sciezkab = '/home/klient.dhosting.pl/webska/lvadshirt.com/tmp/settings.log';
//file_put_contents($sciezkab, $bufor, FILE_APPEND);

?>