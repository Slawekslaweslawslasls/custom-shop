<?php
error_reporting(0);
include('../include/settings.inc.php');
include('../include/lib.inc.php');

$akcja = $_POST['akcja'];
if($akcja == "dodaj"){
    $typ_towaru = $_POST['typ_towaru'];
    $wybrana_plec = $_POST['wybrana_plec']; 
    $wybrany_rodzaj_koszulki = $_POST['wybrany_rodzaj_koszulki'];
    $wybrany_rozmiar = $_POST['wybrany_rozmiar'];
    $wybrany_kolor = $_POST['wybrany_kolor'];

    $znal = false;
    foreach($_SESSION['koszyk'] as $klucz =>$towar){
	if($towar['typ'] == $typ_towaru && $towar['plec'] == $wybrana_plec && $towar['rodzaj_koszulki'] == $wybrany_rodzaj_koszulki && $towar['rozmiar'] == $wybrany_rozmiar && $towar['kolor'] == $wybrany_kolor){
	    $znal = true;
		$_SESSION['koszyk'][$klucz]['ilosc']++;		
	}
    }	
    if(!$znal){
		//$i = $_SESSION['ilosc'];
		$towar = array('typ'=>$typ_towaru, 'plec'=>$wybrana_plec, 'rodzaj_koszulki'=>$wybrany_rodzaj_koszulki, 'rozmiar'=>$wybrany_rozmiar, 'kolor'=>$wybrany_kolor, 'ilosc'=>1, 'powloka'=>0);
		/*
        $_SESSION['koszyk'][]['typ'] = $typ_towaru;
		$_SESSION['koszyk'][]['plec'] = $wybrana_plec;
		$_SESSION['koszyk'][]['rodzaj_koszulki'] = $wybrany_rodzaj_koszulki;
		$_SESSION['koszyk'][]['rozmiar'] = $wybrany_rozmiar;
		$_SESSION['koszyk'][]['kolor'] = $wybrany_kolor;
		$_SESSION['koszyk'][]['ilosc'] = 1;
		*/
		array_push($_SESSION['koszyk'], $towar);
		$_SESSION['ilosc']++;
    }

    if($_SESSION['id_zam'] != 0){
	$id_zam = $_SESSION['id_zam'];
	
	$query = "delete from zamowienie_pozycja where zamowienie_id=".$id_zam;
	mysqli_query($DB, $query);
	$query = "select jezyk_id from zamowienie where id=".$id_zam;
	$resj = mysqli_query($DB, $query);
	$wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['jezyk_id'];
	
	foreach($_SESSION['koszyk'] as $pozycja){
	    $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
	    $wierszc = mysqli_fetch_array($resc);
		if($wierszc['cena_promocyjna']!=''){
			$wierszc['cena'] = $wierszc['cena_promocyjna'];
		}
	    if($pozycja['typ'] == 1){
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    }else{
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    
	    }
	    mysqli_query($DB, $query);
	
	}
    }
	//marketing
	
	$res = mysqli_query($DB, "select id from towar t where t.kolor_id=".$wybrany_kolor." and t.rodzaj_koszulki_id=".$wybrany_rodzaj_koszulki." and t.rozmiar_id=".$wybrany_rozmiar." and t.typ_towaru_id=1 and t.plec='".$wybrana_plec."' and dostepny=1");
	$wiersz = mysqli_fetch_array($res);
	$towar_id = $wiersz['id'];
	mysqli_query($DB, "update marketing set koszulka=".$towar_id." where email='".$_SESSION['email']."'");
	
	// marketing koniec

}elseif($akcja == "dodaj_dod"){
    $typ_towaru = $_POST['typ_towaru'];

    $znal = false;
    foreach($_SESSION['koszyk'] as $klucz =>$towar){
	if($towar['typ'] == $typ_towaru){
	    $znal = true;
	    $_SESSION['koszyk'][$klucz]['ilosc']++;
	}
    }	
    if(!$znal){
		//$i = $_SESSION['ilosc'];
		/*
        $_SESSION['koszyk'][]['typ'] = $typ_towaru;
		$_SESSION['koszyk'][]['ilosc'] = 1;
		*/
		$towar = array('typ' => $typ_towaru, 'ilosc' => 1);
		array_push($_SESSION['koszyk'], $towar);
		$_SESSION['ilosc']++;
    }

    if($_SESSION['id_zam'] != 0){
	$id_zam = $_SESSION['id_zam'];

	$query = "delete from zamowienie_pozycja where zamowienie_id=".$id_zam;
	mysqli_query($DB, $query);

	$query = "select jezyk_id from zamowienie where id=".$id_zam;
	$resj = mysqli_query($DB, $query);
	$wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['jezyk_id'];
	
	foreach($_SESSION['koszyk'] as $pozycja){
	    $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
	    $wierszc = mysqli_fetch_array($resc);
		if($wierszc['cena_promocyjna']!=''){
			$wierszc['cena'] = $wierszc['cena_promocyjna'];
		}	
	    if($pozycja['typ'] == 1){
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    }else{
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    
	    }
	    mysqli_query($DB, $query);
	
	}
    }

}elseif($akcja=="powloka"){
	$klucz = $_POST['klucz'];
	$powloka=$_POST['powloka'];
	$_SESSION['koszyk'][$klucz]['powloka']=(int)$powloka;
	$id_zam = $_SESSION['id_zam'];

	
	$query = "delete from zamowienie_pozycja where zamowienie_id=".$id_zam;
	mysqli_query($DB, $query);
	$query = "select jezyk_id from zamowienie where id=".$id_zam;
	$resj = mysqli_query($DB, $query);
	$wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['jezyk_id'];

	foreach($_SESSION['koszyk'] as $pozycja){
	   $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
	    $wierszc = mysqli_fetch_array($resc);
		if($wierszc['cena_promocyjna']!=''){
			$wierszc['cena'] = $wierszc['cena_promocyjna'];
		}
	    if($pozycja['typ'] == 1){
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`, `powloka`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].", ".$pozycja['powloka'].");";
	    }else{
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    
	    }
	    mysqli_query($DB, $query);
	
	}

}elseif($akcja == "plus"){
    $klucz = $_POST['klucz'];
    $_SESSION['koszyk'][$klucz]['ilosc']++;

    if($_SESSION['id_zam'] != 0){
	$id_zam = $_SESSION['id_zam'];

	
	$query = "delete from zamowienie_pozycja where zamowienie_id=".$id_zam;
	mysqli_query($DB, $query);

	$query = "select jezyk_id from zamowienie where id=".$id_zam;
	$resj = mysqli_query($DB, $query);
	$wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['jezyk_id'];
	

	foreach($_SESSION['koszyk'] as $pozycja){
	    $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
	    $wierszc = mysqli_fetch_array($resc);
		if($wierszc['cena_promocyjna']!=''){
			$wierszc['cena'] = $wierszc['cena_promocyjna'];
		}
	    if($pozycja['typ'] == 1){
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`, `powloka`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].", ".$pozycja['powloka'].");";
	    }else{
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    
	    }
	    mysqli_query($DB, $query);
	
	}
    }

    
}elseif($akcja == "minus"){
    $klucz = $_POST['klucz'];
    $_SESSION['koszyk'][$klucz]['ilosc']--;

    if($_SESSION['id_zam'] != 0){
	$id_zam = $_SESSION['id_zam'];

	
	$query = "delete from zamowienie_pozycja where zamowienie_id=".$id_zam;
	mysqli_query($DB, $query);

	$query = "select jezyk_id from zamowienie where id=".$id_zam;
	$resj = mysqli_query($DB, $query);
	$wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['jezyk_id'];
	
	foreach($_SESSION['koszyk'] as $pozycja){
	    $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
	    $wierszc = mysqli_fetch_array($resc);
		if($wierszc['cena_promocyjna']!=''){
			$wierszc['cena'] = $wierszc['cena_promocyjna'];
		}
	    if($pozycja['typ'] == 1){
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`, `powloka`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].",".$pozycja['powloka'].");";
	    }else{
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    
	    }
	    mysqli_query($DB, $query);
	
	}
    }
    
}elseif($akcja == "usun"){
    $klucz = $_POST['klucz'];
    unset($_SESSION['koszyk'][$klucz]);
    $_SESSION['ilosc']--;
	
	// spraedzenie czy zostaly same saszetki
	
	$tylko_szaszetki = true;
	foreach($_SESSION['koszyk'] as $pozycja){
		if($pozycja['typ'] == 1){
			$tylko_szaszetki = false;
		}
	}
	if($tylko_szaszetki){
	    $_SESSION['koszyk'] = array();
		$_SESSION['ilosc'] = 0;	
	}
	
	reset($_SESSION['koszyk']);
	
	// usuwanie
	
    if($_SESSION['ilosc'] == 0){
	echo "pusty";
    }

    if($_SESSION['id_zam'] != 0){
	$id_zam = $_SESSION['id_zam'];

	$query = "delete from zamowienie_pozycja where zamowienie_id=".$id_zam;
	mysqli_query($DB, $query);

	$query = "select jezyk_id from zamowienie where id=".$id_zam;
	$resj = mysqli_query($DB, $query);
	$wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['jezyk_id'];
	
	foreach($_SESSION['koszyk'] as $pozycja){
	    $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
	    $wierszc = mysqli_fetch_array($resc);
		if($wierszc['cena_promocyjna']!=''){
			$wierszc['cena'] = $wierszc['cena_promocyjna'];
		}
	    if($pozycja['typ'] == 1){
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    }else{
		$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
	    
	    }
	    mysqli_query($DB, $query);
	
	}
    }

}elseif($akcja == "rabat"){ 
    $kraj = $_POST['kraj'];
    $kod = mysqli_escape_string($DB, $_POST['kod']);
   	
    if($_SESSION['kod'] == 0){
	
	$query = "select kr.id, r.wartosc_kwotowa, r.wartosc_procentowa, kr.hurt, kr.hurt_typ, kr.hurt_ilosc from kod_rabatowy kr, rabat r, dict_jezyk j where kr.kod like '".$kod."' and (kr.jednorazowy=0 or (kr.jednorazowy=1 and kr.wykorzystany=0)) and r.id=kr.rabat_id and ((kr.jezyk_id=j.id and j.skrot='".$lang."') or (kr.jezyk_id=0)) and r.aktywny=1";
	$res = mysqli_query($DB, $query);
	if(mysqli_num_rows($res) > 0){
	    $_SESSION['kod'] = 1;
	    $_SESSION['kod_nr'] = $kod;
		
	    $wiersz = mysqli_fetch_array($res);
		//var_dump($wiersz);
		$query = "update kod_rabatowy set wykorzystany=1 where id=".$wiersz['id'];
		mysqli_query($DB, $query);		
		
	    if($wiersz['wartosc_kwotowa'] != '' && $wiersz['wartosc_kwotowa'] != 0){
		$rodzaj = 'k';
		$rabat = $wiersz['wartosc_kwotowa'];
	    }else{
		$rodzaj = 'p';
		$rabat = $wiersz['wartosc_procentowa'];
	    }
	    
	    $_SESSION['kod_rodzaj'] = $rodzaj;
	    $_SESSION['kod_rabat'] = $rabat;
		$_SESSION['kod_hurt'] = $wiersz['hurt'];
		$_SESSION['kod_hurt_typ'] = $wiersz['hurt_typ'];
		$_SESSION['kod_hurt_ilosc'] = $wiersz['hurt_ilosc'];
		
		if($_SESSION['kod_hurt'] == 1 && $_SESSION['kod_hurt_typ'] == 0 && $_SESSION['kod_hurt_ilosc'] == 0){
			$_SESSION['kod_hurt_typ'] = $_DISCOUNT_TYPE;
			$_SESSION['kod_hurt_ilosc'] = $_DISCOUNT_NUM;
		}
		echo $_SESSION['kod_rodzaj'].':'.$_SESSION['kod_rabat'].':'.$_SESSION['kod_hurt'].':'.$_SESSION['kod_hurt_typ'].':'.$_SESSION['kod_hurt_ilosc'];
	    
	    if($_SESSION['id_zam'] != 0){
		$query = "update zamowienie set kod_rabatowy_id=".$wiersz['id']." where id=".$_SESSION['id_zam'];
		$res = mysqli_query($DB, $query);
	    }
	    
	}else{
	    echo 'blad';
	}
    }else{
	echo 'wpisany';
    }
    
}elseif($akcja == "kraj"){
    $krid = $_POST['krid'];
    $_SESSION['wysylka_kraj'] = $krid;

    if($_SESSION['id_zam'] != 0){
	$id_zam = $_SESSION['id_zam'];
	$query = "update zamowienie set kraj_wysylki_id=".$krid.", kraj_zam_id=".$krid.", wojewodztwo_zam_id=0 where id=".$id_zam;
	mysqli_query($DB, $query);
	$query = "select odbiorca_id from zamowienie where id=".$id_zam;
	$res = mysqli_query($DB, $query);
	$wiersz = mysqli_fetch_array($res);
	if($wiersz['odbiorca_id'] != ''){
		$query = "update zamowienie set kraj_odb_id=".$krid.", wojewodztwo_odb_id=0 where id=".$id_zam;
		mysqli_query($DB, $query);		
	}

    }
	setcookie("wysylka", $krid, time()+60*60*24*30, "/");
    
}elseif($akcja == "zacznij_zamawianie"){
    if($_SESSION['etap'] < 1){
	$_SESSION['etap'] = 1;	
    }

}elseif($akcja == "zapisz_dane_klienta"){
    $imie = mysqli_escape_string($DB, $_POST['imie']);
    $nazwisko = mysqli_escape_string($DB, $_POST['nazwisko']);
    $firma = mysqli_escape_string($DB, $_POST['firma']);
    $email = mysqli_escape_string($DB, $_POST['email']);
    $adres = mysqli_escape_string($DB, $_POST['adres']);
    $adres2 = mysqli_escape_string($DB, $_POST['adres2']);
    $adres = mysqli_escape_string($DB, $_POST['adres']);
    $kod = mysqli_escape_string($DB, $_POST['kod']);
    $tel = mysqli_escape_string($DB, $_POST['tel']);
    $miasto = mysqli_escape_string($DB, $_POST['miasto']);
    $woj = $_POST['woj'];
    $kraj = $_POST['kraj'];
	$nagranie = $_POST['nagranie'];
	
    $_SESSION['imie'] = $imie;
    $_SESSION['nazwisko'] = $nazwisko;
    $_SESSION['email'] = $email;
    $_SESSION['kraj'] = $kraj;	

    $imie_odb=mysqli_escape_string($DB,$_POST['imie_odb']);
    $nazwisko_odb=mysqli_escape_string($DB,$_POST['nazwisko_odb']);
    $firma_odb=mysqli_escape_string($DB,$_POST['firma_odb']);
    $email_odb=mysqli_escape_string($DB,$_POST['email_odb']);
    $adres_odb=mysqli_escape_string($DB,$_POST['adres_odb']);
    $adres2_odb=mysqli_escape_string($DB,$_POST['adres2_odb']);
    $kod_odb=mysqli_escape_string($DB,$_POST['kod_odb']);
    $miejsc_odb=mysqli_escape_string($DB,$_POST['miejsc_odb']);
    $tel_odb=mysqli_escape_string($DB,$_POST['tel_odb']);
    $kraj_odb=mysqli_escape_string($DB,$_POST['kraj_odb']);
    $woj_odb=mysqli_escape_string($DB, $_POST['woj_odb']);
    $adres_wysylki=mysqli_escape_string($DB, $_POST['adres_wysylki']);
	 
    if($_SESSION['kod'] != 0){
		$query = "select * from kod_rabatowy where kod like '".$_SESSION['kod_nr']."'";
		$res = mysqli_query($DB, $query);
		$wiersz = mysqli_fetch_array($res);
		$rabat = $wiersz['id'];
    }else{
			$rabat = 0;
    }

    $ip = getUserIP();
    
	$query = "select id from dict_jezyk where skrot='".$lang."'";
    $resj = mysqli_query($DB, $query);
    $wierszj = mysqli_fetch_array($resj);
	$id_j = $wierszj['id'];
	
    if($_SESSION['id_zam'] == 0){
			$query = "INSERT INTO `klient` (`imie`, `nazwisko`, `email`, `firma`, `adres1`, `adres2`, `miasto`, `wojewodztwo_id`, `kraj_id`, `kod_pocztowy`, `telefon`, `data`, `ip`) VALUES ('".$imie."', '".$nazwisko."', '".$email."', '".$firma."', '".$adres."', '".$adres2."', '".$miasto."', ".$woj.", ".$kraj.", '".$kod."', '".$tel."', NOW(), '".$ip."');";

        		mysqli_query($DB, $query);
				$id_kl = mysqli_insert_id($DB);
    			

    				if($adres_wysylki == 'odb'){
 							$query = "INSERT INTO `zamowienie` (`zamawiajacy_id`, `kraj_wysylki_id`, `jezyk_id`, `data`, `kod_rabatowy_id`, `etap_id`, `imie_zam`, `nazwisko_zam`, `email_zam`, `firma_zam`, `adres1_zam`, `adres2_zam`, `miasto_zam`, `wojewodztwo_zam_id`, `kraj_zam_id`, `kod_pocztowy_zam`, `telefon_zam`, `ip_zam`, `hasz`, `campaign`, `keyword`,`referer`,`nagranie`,`wysylka`,`imie_odb`, `nazwisko_odb`, `email_odb`, `firma_odb`, `adres1_odb`, `adres2_odb`, `miasto_odb`, `wojewodztwo_odb_id`, `kraj_odb_id`, `kod_pocztowy_odb`, `telefon_odb`) VALUES (".$id_kl.", ".$_SESSION['wysylka_kraj'].", ".$id_j.", NOW(), '".$rabat."', 2, '".$imie."', '".$nazwisko."', '".$email."', '".$firma."', '".$adres."', '".$adres2."', '".$miasto."', ".$woj.", ".$kraj.", '".$kod."', '".$tel."', '".$ip."', md5(id+NOW()), '".$_SESSION['c']."', '".$_SESSION['e']."', '".$_SESSION['HTTP_REFERER']."', '".$nagranie."','".$adres_wysylki."','".$imie_odb."','".$nazwisko_odb."','".$email_odb."','".$firma_odb."','".$adres_odb."','".$adres2_odb."','".$miejsc_odb."',".$woj_odb.",".$kraj_odb.",'".$kod_odb."','".$tel_odb."');";
 							
						}
						
					else{
							$query = "INSERT INTO `zamowienie` (`zamawiajacy_id`, `kraj_wysylki_id`, `jezyk_id`, `data`, `kod_rabatowy_id`, `etap_id`, `imie_zam`, `nazwisko_zam`, `email_zam`, `firma_zam`, `adres1_zam`, `adres2_zam`, `miasto_zam`, `wojewodztwo_zam_id`, `kraj_zam_id`, `kod_pocztowy_zam`, `telefon_zam`, `ip_zam`, `wysylka`,`hasz`, `campaign`, `keyword`,`referer`,`nagranie`) VALUES (".$id_kl.", ".$_SESSION['wysylka_kraj'].", ".$id_j.", NOW(), '".$rabat."', 2, '".$imie."', '".$nazwisko."', '".$email."', '".$firma."', '".$adres."', '".$adres2."', '".$miasto."', ".$woj.", ".$kraj.", '".$kod."', '".$tel."', '".$ip."','".$adres_wysylki."', md5(id+NOW()), '".$_SESSION['c']."', '".$_SESSION['e']."', '".$_SESSION['HTTP_REFERER']."', '".$nagranie."');";

	
						} 
						

						mysqli_query($DB, $query);
						$id_zam = mysqli_insert_id($DB);
						//$_SESSION['kod_google']= $id_zam;
						foreach($_SESSION['koszyk'] as $pozycja){
							    $resc = mysqli_query($DB, "select * from cennik c where c.typ_towaru_id=".$pozycja['typ']." and c.jezyk_id=".$id_j);
							    $wierszc = mysqli_fetch_array($resc);
										if($wierszc['cena_promocyjna']!=''){
											$wierszc['cena'] = $wierszc['cena_promocyjna'];
										}
							    		if($pozycja['typ'] == 1){
							    	
											$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `plec`, `rodzaj_koszulki_id`, `rozmiar_id`, `kolor_id`, `cena`, `ilosc`, `powloka`) VALUES (".$id_zam.", ".$pozycja['typ'].", '".$pozycja['plec']."', ".$pozycja['rodzaj_koszulki'].", ".$pozycja['rozmiar'].", ".$pozycja['kolor'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].", ".$pozycja['powloka'].");";
							    		}else{
							    	
											$query = "INSERT INTO `zamowienie_pozycja` (`zamowienie_id`, `typ_towaru_id`, `cena`, `ilosc`) VALUES (".$id_zam.", ".$pozycja['typ'].", ".$wierszc['cena'].", ".$pozycja['ilosc'].");";
							    
							    			}
							    mysqli_query($DB, $query);
	
						}
						$_SESSION['id_zam'] = $id_zam;
    }else{
	   
		$query = "select * from zamowienie where id=".$_SESSION['id_zam'];
		$res = mysqli_query($DB, $query);
		$wiersz = mysqli_fetch_array($res);
		$zamawiajacy_id = $wiersz['zamawiajacy_id'];
		



		$query = "update klient set imie='".$imie."', nazwisko='".$nazwisko."', email='".$email."', firma='".$firma."', adres1='".$adres."',  adres2='".$adres2."', miasto='".$miasto."', wojewodztwo_id=".$woj.", kraj_id=".$kraj.", kod_pocztowy='".$kod."', telefon='".$tel."', data=NOW(), ip='".$ip."'  where id=".$zamawiajacy_id;
		mysqli_query($DB, $query);

		

		$query = "UPDATE zamowienie SET imie_zam='".$imie."', nazwisko_zam='".$nazwisko."', email_zam='".$email."', firma_zam='".$firma."', adres1_zam='".$adres."',  adres2_zam='".$adres2."', miasto_zam='".$miasto."', wojewodztwo_zam_id=".$woj.", kraj_zam_id=".$kraj.", kod_pocztowy_zam='".$kod."', telefon_zam='".$tel."', ip_zam='".$ip."', nagranie='".$nagranie."', wysylka='".$adres_wysylki."', imie_odb='".$imie_odb."',nazwisko_odb='".$nazwisko_odb."',firma_odb='".$firma_odb."',email_odb='".$email_odb."',adres1_odb='".$adres_odb."',adres2_odb='".$adres2_odb."',kod_pocztowy_odb='".$kod_odb."',miasto_odb='".$miejsc_odb."',telefon_odb='".$tel_odb."',kraj_odb_id='".$kraj_odb."',wojewodztwo_odb_id='".$woj_odb."' WHERE id=".$_SESSION['id_zam'];
		mysqli_query($DB, $query);
	}
	
    
    
    if($_SESSION['etap'] < 2){
		$_SESSION['etap'] = 2;
    }
   
	
	// marketing
	
	$resm = mysqli_query($DB,"select email from marketing where email = '".$email."'");
	$ilem = mysqli_num_rows($resm);
	if($ilem == 0){
		mysqli_query($DB, "insert into marketing (email, imie, nazwisko, ip, jezyk, data_wprowadzenia, data_modyfikacji) values ('".$email."','".$imie."','".$nazwisko."', '".$ip."', ".$id_j.", NOW(), NOW())");
	}else{
		mysqli_query($DB, "update marketing set imie='".$imie."', nazwisko='".$nazwisko."' ,jezyk=".$id_j.", data_modyfikacji=NOW() where email='".$email."'");
		mysqli_query($DB, "update marketing set ip='".$ip."', data_modyfikacji=NOW() where email='".$email."' and zgoda=0");	
	}
	
	// koniec marketing
}elseif($akcja == "paylane"){
	
    $numKarty=$_POST['numer_karty'];
    $lang=$_POST['lang'];
	if(substr($numKarty,0,2)=='37'&& $lang!=='us'){
        echo 'no';
    }
    else{
    	echo 'yes';
		$_SESSION['wk'] = $_POST['name_card'];
    	$_SESSION['nrk'] = $_POST['numer_karty'];
    	$_SESSION['kwk'] = $_POST['code_card'];
    	$_SESSION['mies'] = $_POST['mies'];
    	$_SESSION['rok'] = $_POST['rok'];
		$_SESSION['kwota_laczna'] = $_POST['kwota_laczna'];	

		
    }

}

elseif($akcja=="koniec_zamowienia"){
$_SESSION['koszyk']=array();
$_SESSION['ilosc']=0;
//unset($_SESSION['koszyk']);
//reset($_SESSION['koszyk']);
}
/*elseif($akcja == "zapisz_dane_wysylki"){
    $adres_wysylki = mysqli_escape_string($DB, $_POST['adres_wysylki']);
    $typ_platnosci = $_POST['typ_platnosci'];
    $imie = mysqli_escape_string($DB, $_POST['imie']);
    $nazwisko = mysqli_escape_string($DB, $_POST['nazwisko']);
    $firma = mysqli_escape_string($DB, $_POST['firma']);
    $email = mysqli_escape_string($DB, $_POST['email']);
    $adres = mysqli_escape_string($DB, $_POST['adres']);
    $adres2 = mysqli_escape_string($DB, $_POST['adres2']);
    $kod = mysqli_escape_string($DB, $_POST['kod']);
    $tel = mysqli_escape_string($DB, $_POST['tel']);
    $miasto = mysqli_escape_string($DB, $_POST['miasto']);
    $woj = $_POST['woj'];
    $kraj = $_POST['kraj'];

	$imie_odb=$POST['imie_odb'];
    $nazwisko_odb=$POST['nazwisko_odb'];
    $firma_odb=$POST['firma_odb'];
    $email_odb=$POST['email_odb'];
    $adres_odb=$POST['adres_odb'];
    $adres2_odb=$POST['adres2_odb'];
    $kod_odb=$POST['kod_odb'];
    $miejsc_odb=$POST['miejsc_odb'];
    $tel_odb=$POST['tel_odb'];
    $kraj_odb=$POST['kraj_odb'];
    $woj_odb=$POST['woj_odb'];


    //$_SESSION['wk'] = $_POST['wk'];
    //$_SESSION['nrk'] = $_POST['nrk'];
    //$_SESSION['kwk'] = $_POST['kwk'];
    //$_SESSION['mies'] = $_POST['mies'];
    //$_SESSION['rok'] = $_POST['rok'];
    
    $ip = getUserIP();
    
    $query = "select * from zamowienie where id=".$_SESSION['id_zam'];
    $res = mysqli_query($DB, $query);
    $wiersz = mysqli_fetch_array($res);
    $id_odb = $wiersz['odbiorca_id'];

    if($adres_wysylki == 'odb'){
		if($id_odb != ''){
	    $query = "update klient set imie='".$imie."', nazwisko='".$nazwisko."', email='".$email."', firma='".$firma."', adres1='".$adres."',  adres2='".$adres2."', miasto='".$miasto."', wojewodztwo_id=".$woj.", kraj_id=".$kraj.", kod_pocztowy='".$kod."', telefon='".$tel."', data=NOW(), ip='".$ip."' where id=".$id_odb; 
	    mysqli_query($DB, $query);
		}else{
	    $query = "INSERT INTO `klient` (`imie`, `nazwisko`, `email`, `firma`, `adres1`, `adres2`, `miasto`, `wojewodztwo_id`, `kraj_id`, `kod_pocztowy`, `telefon`, `data`, `ip`) VALUES ('".$imie."', '".$nazwisko."', '".$email."', '".$firma."', '".$adres."', '".$adres2."', '".$miasto."', ".$woj.", ".$kraj.", '".$kod."', '".$tel."', NOW(), '".$ip."');";
	    mysqli_query($DB, $query);
	    $id_odb = mysqli_insert_id($DB);
		}
		
	$odb_str1 = 'odbiorca_id='.$id_odb.', ';
	$odb_str2 = ", imie_odb='".$imie."',nazwisko_odb='".$nazwisko."',email_odb='".$email."',firma_odb='".$firma."',adres1_odb='".$adres."',adres2_odb='".$adres2."',miasto_odb='".$miasto."',wojewodztwo_odb_id=".$woj.",kraj_odb_id=".$kraj.",kod_pocztowy_odb='".$kod."',telefon_odb='".$tel."',imie_odb='".$imie_odb."',nazwisko_odb='".$nazwisko_odb."',firma_odb='".$firma_odb."',email_odb='".$email_odb."',adres1_odb='".$adres_odb."',adres2_odb='".$adres2_odb."',kod_pocztowy_odb='".$kod_odb."',miasto_odb='".$miejsc_odb."',telefon_odb='".$tel_odb."',kraj_odb_id='".$kraj_odb."', wojewodztwo_odb_id='".$woj_odb;	
	}else{
		if($id_odb != ''){
		    $query = "delete from klient where id=".$id_odb;
		    mysqli_query($DB, $query);
		
		    $odb_str1 = 'odbiorca_id=NULL, ';
		    $odb_str2 = ", imie_odb='test',nazwisko_odb=NULL,email_odb=NULL,firma_odb=NULL,adres1_odb=NULL,adres2_odb=NULL,miasto_odb=NULL,wojewodztwo_odb_id=NULL,kraj_odb_id=NULL,kod_pocztowy_odb=NULL,telefon_odb=NULL";
		}else{
		    $odb_str1 = '';
		    $odb_str2 = '';
		}
	
    }
    
    $query = "UPDATE `zamowienie` SET ".$odb_str1." `typ_platnosci_id`=".$typ_platnosci.",`etap_id`=3 ".$odb_str2." where id=".$_SESSION['id_zam'];
	mysqli_query($DB, $query);
    
    if($_SESSION['etap'] < 3){
	$_SESSION['etap'] = 3;
    }
 */  
elseif($akcja == "wyslij_zamowienie"){

    $daneosobowe = $_POST['daneosobowe'];
    if(isset($_POST['kwota_laczna']) && isset($_POST['rabat']) && isset($_POST['koszt_wysylki'])){
	$kwota_laczna = $_POST['kwota_laczna'];
	$rabat = $_POST['rabat'];
	$koszt_wysylki = $_POST['koszt_wysylki'];
	$query = "update zamowienie set daneosobowe=".$daneosobowe.", wartosc_kwota=".$kwota_laczna.", ";
	$query .= "rabat_kwota=".$rabat.", koszt_wysylki_kwota=".$koszt_wysylki." where id=".$_SESSION['id_zam'];
    }else{
	$query = "update zamowienie set daneosobowe=".$daneosobowe." where id=".$_SESSION['id_zam'];
    }
    
    mysqli_query($DB, $query);

	// marketing
	
	$ip = getUserIP();
	
	$resm = mysqli_query($DB,"select email_zam from zamowienie where id = ".$_SESSION['id_zam']);
	$wierszm = mysqli_fetch_array($resm);
	$email = $wierszm['email_zam'];
	
	mysqli_query($DB, "update marketing set typ_pompy=1, zgoda=".$daneosobowe.", ip='".$ip."', data_modyfikacji=NOW() where email='".$email."'");

	// nowe zakupy do tablic
	$towar_ids = array();
	$towar_ils = array();
	$reszp = mysqli_query($DB, "select ilosc, plec, rodzaj_koszulki_id, rozmiar_id, kolor_id from zamowienie_pozycja where typ_towaru_id=1 and zamowienie_id=".$_SESSION['id_zam']);
	$i = 0;
	while($wierszzp = mysqli_fetch_array($reszp)){
		$i++;
		$rest = mysqli_query($DB, "select id from towar where plec='".$wierszzp['plec']."' and rodzaj_koszulki_id=".$wierszzp['rodzaj_koszulki_id']." and rozmiar_id=".$wierszzp['rozmiar_id']." and kolor_id=".$wierszzp['kolor_id']);
		$wierszt = mysqli_fetch_array($rest);
		$towar_ids[$i] = $wierszt['id'];
		$towar_ils[$i] = $wierszzp['ilosc'];
	}
		
	$resm = mysqli_query($DB, "select koszulka_zakup from marketing where email='".$email."'");
	$wierszm = mysqli_fetch_array($resm);
	$zakupy = $wierszm['koszulka_zakup'];
	
	// stare zakupy do tablic
	$zakup_ids = array();
	$zakup_ils = array();
	if($zakupy != ''){
		$zakupy = explode(';', $zakupy);
		$i = 0;
		foreach($zakupy as $zakup){
			$i++;
			list($zakup_id, $zakup_il) = explode(':', $zakup);
			$zakup_ids[$i] = $zakup_id;
			$zakup_ils[$i] = $zakup_il;			
		}
	}
	// dokladamy nowe do starych
	$ile = count($towar_ids);
	$j = count($zakup_ids);
	for($i=1;$i<=$ile;$i++){
		$towar_id = $towar_ids[$i];
		$towar_il = $towar_ils[$i];
		$k = array_search($towar_id, $zakup_ids);
		if($k!== false){
			$zakup_ils[$k]+=$towar_il;
		}else{
			$j++;
			$zakup_ids[$j] = $towar_id;
			$zakup_ils[$j] = $towar_il;
		}
	}

	// wspolne zakupy do napisu	
	$ile = count($zakup_ids);
	$zakupy = '';
	for($i=1;$i<=$ile;$i++){
		$zakup_id = $zakup_ids[$i];
		$zakup_il = $zakup_ils[$i];
		$zakup = $zakup_id.":".$zakup_il;
		$zakupy .= ';'.$zakup;
	}
	
	$zakupy = substr($zakupy, 1);
	

	mysqli_query($DB, "update marketing set koszulka_zakup='".$zakupy."', data_modyfikacji=NOW() where email='".$email."'");
	// koniec marketing
	
    $_SESSION['koszyk'] = array();
    //$_SESSION['ilosc'] = 0;
    $_SESSION['kod'] = 0;
    $_SESSION['kod_nr'] = 'Wpisz kod';
    $_SESSION['kod_rodzaj'] = 'k';
    $_SESSION['kod_rabat'] = 0;
	$_SESSION['kod_hurt'] = 0;
	$_SESSION['kod_hurt_typ'] = 0;
	$_SESSION['kod_hurt_ilosc'] = 0;	
    $_SESSION['wysylka_kraj'] = 0;
    $_SESSION['etap'] = 0;
    //$_SESSION['id_zam'] = 0;
	


}elseif($akcja == "czysc_koszyk"){

    $_SESSION['koszyk'] = array();
    $_SESSION['ilosc'] = 0;
    $_SESSION['kod'] = 0;
    $_SESSION['kod_nr'] = 'Wpisz kod';
    $_SESSION['kod_rodzaj'] = 'k';
    $_SESSION['kod_rabat'] = 0;
	$_SESSION['kod_hurt'] = 0;
	$_SESSION['kod_hurt_typ'] = 0;
	$_SESSION['kod_hurt_ilosc'] = 0;	
    $_SESSION['wysylka_kraj'] = 0;
    $_SESSION['etap'] = 0;
    $_SESSION['id_zam'] = 0;

}
/*
elseif($akcja == "nagranie"){
	$nagranie = $_POST['nagranie'];
	$query = "UPDATE `zamowienie` SET `nagranie`='".$nagranie."' where id=".$_SESSION['id_zam'];
	var_dump($query);
	mysqli_query($DB, $query);
	var_dump(mysqli_error($DB));
    
}
*/
elseif($akcja == "google_kod_sprzedazu"){
}
$query="UPDATE `klient` SET `google_kod`=1".$nagranie."' where id=".$_SESSION['id_zam'];

?>
