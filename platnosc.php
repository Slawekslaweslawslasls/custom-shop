<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
    $_SESSION['koszyk'] = array();
    $_SESSION['ilosc'] = 0;
    $_SESSION['kod'] = 0;
    $_SESSION['kod_nr'] = 'Wpisz kod';
    $_SESSION['kod_rodzaj'] = 'k';
    $_SESSION['kod_rabat'] = 0;
    $_SESSION['wysylka_kraj'] = 0;
    $_SESSION['etap'] = 0;
    $_SESSION['id_zam'] = 0;

    $id = $_GET['id'];
    $res = mysqli_query($DB, "select * from zamowienie where hasz = '".$id."'");

    if(mysqli_num_rows($res) == 0){
	header('Location: https://'.$_SERV.$_PATH.'/koszyk-pusty.html');
    }else{
	$wiersz = mysqli_fetch_array($res);
	if($wiersz['etap_id'] == 5 || $wiersz['etap_id'] == 7){
	    header('Location: https://'.$_SERV.$_PATH.'/zamowienie.html');
	}else{
	
	    $resr  = mysqli_query($DB, "select kr.kod, r.wartosc_kwotowa, r.wartosc_procentowa, from zamowienie z, kod_rabatowy kr, rabat r where z.kod_rabatowy_id=kr.id and kr.rabat_id=r.id");
	    if(mysqli_num_rows($resr) > 0){
		$wierszr = mysqli_fetch_array($resr);
		$kod = 1;
		$kod_nr = $wierszr['kod'];
		if($wierszr['wartosc_kwotowa'] != '' && $wierszr['wartosc_kwotowa'] != 0){
		    $kod_rodzaj = 'k';
		    $kod_rabat = $wierszr['wartosc_kwotowa'];
		}else{
		    $kod_rodzaj = 'p';
		    $kod_rabat = $wierszr['wartosc_procentowa'];
		}
	    }else{
		$kod = 0;
		$kod_nr = 'Wpisz kod';
		$kod_rodzaj = 'k';
		$kod_rabat = 0;
	    }

	    $_SESSION['koszyk'] = array();
	    $_SESSION['ilosc'] = 0;
	
	    $resk = mysqli_query($DB, "select * from zamowienie_pozycja where zamowienie_id=".$wiersz['id']);
	    $i = 0;
	    while($wierszk = mysqli_fetch_array($resk)){
		
		$_SESSION['koszyk'][$i]['typ'] = $wierszk['typ_towaru_id'];
		$_SESSION['koszyk'][$i]['plec'] = $wierszk['plec'];
		$_SESSION['koszyk'][$i]['rodzaj_koszulki'] = $wierszk['rodzaj_koszulki_id'];
		$_SESSION['koszyk'][$i]['rozmiar'] = $wierszk['rozmiar_id'];
		$_SESSION['koszyk'][$i]['kolor'] = $wierszk['kolor_id'];
		$_SESSION['koszyk'][$i]['ilosc'] = $wierszk['ilosc'];
		$i++;
	    }
	
	    $_SESSION['ilosc'] = $i;
	    $_SESSION['kod'] = $kod;
	    $_SESSION['kod_nr'] = $kod_nr;
	    $_SESSION['kod_rodzaj'] = $kod_rodzaj;
	    $_SESSION['kod_rabat'] = $kod_rabat;
	    $_SESSION['wysylka_kraj'] = $wiersz['kraj_wysylki_id'];
	    $_SESSION['etap'] = 2;
	    $_SESSION['id_zam'] = $wiersz['id'];
	
	    header('Location: https://'.$_SERV.$_PATH.'/wysylka.html');
	}
    }
?>
