<?php
error_reporting(0);
include('../include/settings.inc.php');
include('../include/lib.inc.php');

$kierunek = $_POST['kierunek'];
$id = $_POST['id'];

if($kierunek == 'left'){
	$resop = mysqli_query($DB, "select max(o.id) as next_id from opinia o, dict_jezyk j where o.active=1 and o.jezyk_id=j.id and j.skrot='".$lang."' and o.id < ".$id);
	$wierszop = mysqli_fetch_array($resop);
	if($wierszop['next_id']!=''){
		$next_id = $wierszop['next_id'];
	}else{
		$resop = mysqli_query($DB, "select max(o.id) as next_id from opinia o, dict_jezyk j where o.active=1 and o.jezyk_id=j.id and j.skrot='".$lang."'");
		$wierszop = mysqli_fetch_array($resop);
		$next_id = $wierszop['next_id'];

	}
}else{
	$resop = mysqli_query($DB, "select min(o.id) as next_id from opinia o, dict_jezyk j where o.active=1 and o.jezyk_id=j.id and j.skrot='".$lang."' and o.id > ".$id);
	$wierszop = mysqli_fetch_array($resop);
	if($wierszop['next_id']!=''){
		$next_id = $wierszop['next_id'];
	}else{
		$resop = mysqli_query($DB, "select min(o.id) as next_id from opinia o, dict_jezyk j where o.active=1 and o.jezyk_id=j.id and j.skrot='".$lang."'");
		$wierszop = mysqli_fetch_array($resop);
		$next_id = $wierszop['next_id'];

	}		
}
$resop = mysqli_query($DB, "select o.imie, o.nazwisko, o.tresc, z.miasto_zam, k.nazwa, o.ocena from opinia o, zamowienie z, dict_kraj k  where z.id=o.zamowienie_id and k.id=z.kraj_zam_id and o.id=".$next_id);

$wierszop = mysqli_fetch_array($resop);

$zdjecie = '';
$dh = opendir($_LANG_PATH.$_PHOTO_PATH);
		
while (($file = readdir($dh)) !== false) {
	$nazwa = substr($file, 0, strpos($file, '.'));
	if($nazwa == $next_id){
		$zdjecie = 'https://'.$_SERV.$_PHOTO_PATH.'/'.$file;
	}
}
echo '<div class="kontener-opinie-naglowek">';
	if($zdjecie != ''){
		echo '<div class="zdjecie-opinie" style="background: url('.$zdjecie.');background-size:auto 50px"></div>';
	}
	echo '<div class="tytul-opinia" data-id="'.$next_id.'">'.$wierszop['imie'].' '.$wierszop['nazwisko'].'</div>';
	echo '<div class="opinia-miejsce"><i>'.$wierszop['miasto_zam'].', '.$wierszop['nazwa'].'</i></div>';
	                             
	echo '<div class="ocena-gwiazdki">';
									
		for($i=0;$i<$wierszop['ocena'];$i++){
			echo '<img src="'.$_SERV_CDN.'/grafika/star.png" alt="gwiazdka">';
		}
	echo '</div>';   
echo '</div>';									
echo '<div class="tresc-opinie"><span>"</span>'.$wierszop['tresc'].'<span>"</span></div>';
?>