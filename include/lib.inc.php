<?php
if(is_file('./PHPMailer/src/PHPMailer.php')){
    require './PHPMailer/src/PHPMailer.php';
	require './PHPMailer/src/Exception.php';
	require './PHPMailer/src/SMTP.php';
}elseif(is_file('../PHPMailer/src/PHPMailer.php')){
    require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/SMTP.php';
}elseif(is_file('../../PHPMailer/src/PHPMailer.php')){
    require '../../PHPMailer/src/PHPMailer.php';
	require '../../PHPMailer/src/Exception.php';
	require '../../PHPMailer/src/SMTP.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function zmien_obrazki($txt, $wybrana_plec, $wybrany_rodzaj_koszulki, $wybrany_kolor){
	global $obrduzysrc, $obrmaly2src, $obrmaly3src, $obrmaly4src, $obrmaly5src, $obrmaly6src, $obrmaly7src, $obrmaly8src, $obrmaly5divpopis, $obrmaly5divpopisfoto, $obrmaly5divklasatekst, $obrmaly5divklasaobszar, $obrmaly7divpopis, $obrmaly7divpopisfoto, $obrmaly7divklasatekst, $obrmaly7divklasaobszar, $obrmaly6divklasatekst, $obrmaly6divklasaobszar, $obrduzyalt, $obrmaly1alt, $obrmaly2alt, $obrmaly3alt, $obrmaly4alt;

    if($wybrana_plec == 'k'){
		$plec = 'kobieta';
		//$altplec = 'kobieta';
    }else{
		$plec = 'meska';
		//$altplec = 'mezczyzna';
    }
    if($wybrany_kolor == 1){
		$kolor = 'biala';
		//$altkolor ='bialy';
    }else{
		$kolor = 'czarna';
		//$altkolor = 'czarny';
    }
    
    if($wybrana_plec == 'k'){
		$koszulka = '';
		//$altkoszulka = 'bezrekawnik'; 
    }else{
		if($wybrany_rodzaj_koszulki == 1){
			$koszulka = '';
			//$altkoszulka = 'rekawnik';
		}else{
			$koszulka = 'bezrekawnik';
			//$altkoszulka = 'bezrekawnik';
		}
    }

	$obrduzyalt = $txt->{'baza'}->{'alt'}->{"obrduzy_".$wybrana_plec.'_'.$wybrany_rodzaj_koszulki.'_'.$wybrany_kolor};
	$obrmaly1alt = $txt->{'baza'}->{'alt'}->{"obrmaly1_".$wybrana_plec.'_'.$wybrany_rodzaj_koszulki.'_'.$wybrany_kolor};
	$obrmaly2alt = $txt->{'baza'}->{'alt'}->{"obrmaly2_".$wybrana_plec.'_'.$wybrany_rodzaj_koszulki.'_'.$wybrany_kolor};
	$obrmaly3alt = $txt->{'baza'}->{'alt'}->{"obrmaly3_".$wybrana_plec.'_'.$wybrany_rodzaj_koszulki.'_'.$wybrany_kolor};
	$obrmaly4alt = $txt->{'baza'}->{'alt'}->{"obrmaly4_".$wybrana_plec.'_'.$wybrany_rodzaj_koszulki.'_'.$wybrany_kolor};

    $nazwa = $plec . '-';
    if($koszulka != ''){
		$nazwa .= $koszulka . '-';
    }
	$nazwa .= $kolor . '-';

    if($wybrana_plec == 'k'){
		if($wybrany_kolor == 1){
			$katalog = 6;
		}else{
			$katalog = 1;
		}
    }else{
		if($wybrany_rodzaj_koszulki == 1){
			if($wybrany_kolor == 1){
				$katalog = 2;
			}else{
				$katalog = 5;
			}
		}else{
			if($wybrany_kolor == 1){
				$katalog = 4;
			}else{
				$katalog = 3;
			}
		}
    }

    $obrduzysrc = '/grafika/produkt'.$katalog.'/'.$nazwa.'8.jpg';
	$obrmaly8src='/grafika/produkt'.$katalog.'/'.$nazwa.'8m.jpg';
	$obrmaly6src='/grafika/produkt'.$katalog.'/'.$nazwa.'6.jpg';
	$obrmaly2src='/grafika/produkt'.$katalog.'/'.$nazwa.'2m.jpg';
	$obrmaly3src='/grafika/produkt'.$katalog.'/'.$nazwa.'3m.jpg';
	$obrmaly4src='/grafika/produkt'.$katalog.'/'.$nazwa.'4m.jpg';

if($wybrana_plec=='k' && $wybrany_rodzaj_koszulki==2 && $wybrany_kolor==1){
	$obrmaly5divpopis = $txt->{'index'}->{'oddychajacatkanina'};
	$obrmaly5divpopisfoto = $txt->{'index'}->{'oddychajacatkaninaopis'};
	$obrmaly7divpopis = $txt->{'index'}->{'wygodnekieszenie'};
	$obrmaly7divpopisfoto = $txt->{'index'}->{'wygodnekieszenieopis'};
	$obrmaly5src='/grafika/produkt'.$katalog.'/'.$nazwa.'7.jpg';
	$obrmaly7src='/grafika/produkt'.$katalog.'/'.$nazwa.'5.jpg';

	$obrmaly5divklasatekst = 'pozycje-teksty-18';
	$obrmaly6divklasatekst = 'pozycje-teksty-17';
	$obrmaly7divklasatekst = 'pozycje-teksty-16';
	
	$obrmaly5divklasaobszar = 'pozycje-obszary-18';
	$obrmaly6divklasaobszar = 'pozycje-obszary-17';
	$obrmaly7divklasaobszar = 'pozycje-obszary-16';
	
}else if($wybrana_plec=='k' && $wybrany_rodzaj_koszulki==2 && $wybrany_kolor==2){
	$obrmaly5divpopis = $txt->{'index'}->{'oddychajacatkanina'};
	$obrmaly5divpopisfoto = $txt->{'index'}->{'oddychajacatkaninaopis'};
	$obrmaly7divpopis = $txt->{'index'}->{'wygodnekieszenie'};
	$obrmaly7divpopisfoto = $txt->{'index'}->{'wygodnekieszenieopis'};
	$obrmaly5src='/grafika/produkt'.$katalog.'/'.$nazwa.'7.jpg';
	$obrmaly7src='/grafika/produkt'.$katalog.'/'.$nazwa.'5.jpg';

	$obrmaly5divklasatekst = 'pozycje-teksty-15';
	$obrmaly6divklasatekst = 'pozycje-teksty-14';
	$obrmaly7divklasatekst = 'pozycje-teksty-13';
	
	$obrmaly5divklasaobszar = 'pozycje-obszary-15';
	$obrmaly6divklasaobszar = 'pozycje-obszary-14';
	$obrmaly7divklasaobszar = 'pozycje-obszary-13';
	
}else if($wybrana_plec=='m' && $wybrany_rodzaj_koszulki==2 && $wybrany_kolor==1){
	$obrmaly5divpopis = $txt->{'index'}->{'oddychajacatkanina'};
	$obrmaly5divpopisfoto = $txt->{'index'}->{'oddychajacatkaninaopis'};
	$obrmaly7divpopis = $txt->{'index'}->{'wygodnekieszenie'};
	$obrmaly7divpopisfoto = $txt->{'index'}->{'wygodnekieszenieopis'};
	$obrmaly5src='/grafika/produkt'.$katalog.'/'.$nazwa.'7.jpg';
	$obrmaly7src='/grafika/produkt'.$katalog.'/'.$nazwa.'5.jpg';

	$obrmaly5divklasatekst = 'pozycje-teksty-9';
	$obrmaly6divklasatekst = 'pozycje-teksty-8';
	$obrmaly7divklasatekst = 'pozycje-teksty-7';
	
	$obrmaly5divklasaobszar = 'pozycje-obszary-9';
	$obrmaly6divklasaobszar = 'pozycje-obszary-8';
	$obrmaly7divklasaobszar = 'pozycje-obszary-7';
		
}else if($wybrana_plec=='m' && $wybrany_rodzaj_koszulki==2 && $wybrany_kolor==2){
	$obrmaly7divpopis = $txt->{'index'}->{'oddychajacatkanina'};
	$obrmaly7divpopisfoto = $txt->{'index'}->{'oddychajacatkaninaopis'};
	$obrmaly5divpopis = $txt->{'index'}->{'wygodnekieszenie'};
	$obrmaly5divpopisfoto = $txt->{'index'}->{'wygodnekieszenieopis'};
	$obrmaly5src='/grafika/produkt'.$katalog.'/'.$nazwa.'5.jpg';
	$obrmaly7src='/grafika/produkt'.$katalog.'/'.$nazwa.'7.jpg';

	$obrmaly5divklasatekst = 'pozycje-teksty-1';
	$obrmaly6divklasatekst = 'pozycje-teksty-2';
	$obrmaly7divklasatekst = 'pozycje-teksty-3';
	
	$obrmaly5divklasaobszar = 'pozycje-obszary-1';
	$obrmaly6divklasaobszar = 'pozycje-obszary-2';
	$obrmaly7divklasaobszar = 'pozycje-obszary-3';	
	
}else if($wybrana_plec=='m' && $wybrany_rodzaj_koszulki==1 && $wybrany_kolor==1){
	$obrmaly7divpopis = $txt->{'index'}->{'oddychajacatkanina'};
	$obrmaly7divpopisfoto = $txt->{'index'}->{'oddychajacatkaninaopis'};
	$obrmaly5divpopis = $txt->{'index'}->{'wygodnekieszenie'};
	$obrmaly5divpopisfoto = $txt->{'index'}->{'wygodnekieszenieopis'};
	$obrmaly5src='/grafika/produkt'.$katalog.'/'.$nazwa.'5.jpg';
	$obrmaly7src='/grafika/produkt'.$katalog.'/'.$nazwa.'7.jpg';

	$obrmaly5divklasatekst = 'pozycje-teksty-10';
	$obrmaly6divklasatekst = 'pozycje-teksty-11';
	$obrmaly7divklasatekst = 'pozycje-teksty-12';
	
	$obrmaly5divklasaobszar = 'pozycje-obszary-10';
	$obrmaly6divklasaobszar = 'pozycje-obszary-11';
	$obrmaly7divklasaobszar = 'pozycje-obszary-12';	
}else if($wybrana_plec=='m' && $wybrany_rodzaj_koszulki==1 && $wybrany_kolor==2){
	$obrmaly5divpopis = $txt->{'index'}->{'oddychajacatkanina'};
	$obrmaly5divpopisfoto = $txt->{'index'}->{'oddychajacatkaninaopis'};
	$obrmaly7divpopis = $txt->{'index'}->{'wygodnekieszenie'};
	$obrmaly7divpopisfoto = $txt->{'index'}->{'wygodnekieszenieopis'};
	$obrmaly5src='/grafika/produkt'.$katalog.'/'.$nazwa.'7.jpg';
	$obrmaly7src='/grafika/produkt'.$katalog.'/'.$nazwa.'5.jpg';

	$obrmaly5divklasatekst = 'pozycje-teksty-6';
	$obrmaly6divklasatekst = 'pozycje-teksty-5';
	$obrmaly7divklasatekst = 'pozycje-teksty-4';
	
	$obrmaly5divklasaobszar = 'pozycje-obszary-6';
	$obrmaly6divklasaobszar = 'pozycje-obszary-5';
	$obrmaly7divklasaobszar = 'pozycje-obszary-4';		

}

}


function weryfikacja_platnosci($id_zam, $kwota_laczna_zew, $waluta_zew, $id_transakcji){
    global $_SERV, $_PATH, $DB, $_LANG_PATH;
	
//$bufor = "DATA: ".date("d-m-Y H:i:s").", IP: ".$_SERVER['REMOTE_ADDR']."\n";	
//$bufor .= "wywolanie funkcji weryfikacja_platnosci\n";
//$bufor .= '$id_zam: '.$id_zam."\n";
//$bufor .= '$kwota_laczna_zew: '.$kwota_laczna_zew."\n";
//$bufor .= '$waluta_zew: '.$waluta_zew."\n";

    $id_zam = intval($id_zam);

//$bufor .= '$id_zam: '.$id_zam."\n";

			
    if(!is_null($kwota_laczna_zew) && !is_null($waluta_zew)){

//$bufor .= 'niepuste dane paypal'."\n";

        $res = mysqli_query($DB, "select wartosc_kwota from zamowienie where id=".$id_zam);
//$bufor .= mysqli_error($DB)."\n";

	$wiersz = mysqli_fetch_array($res);
        $kwota_laczna = $wiersz['wartosc_kwota'];

//$bufor .= '$kwota_laczna: '.$kwota_laczna."\n";

        $kwota_laczna = strval($kwota_laczna);
        
//$bufor .= '$kwota_laczna: '.$kwota_laczna."\n";

        $res = mysqli_query($DB, "select j.waluta from dict_jezyk j, zamowienie z where j.id=z.jezyk_id and z.id=".$id_zam);
//$bufor .= mysqli_error($DB)."\n";
        $wiersz = mysqli_fetch_array($res);
        $waluta = $wiersz['waluta'];

//$bufor .= '$waluta: '.$waluta."\n";
        
        if(strcmp($kwota_laczna_zew, $kwota_laczna)!=0 || (strcmp($waluta_zew, $waluta)!=0)){
//$bufor .= "anulowanie transakcji\n";
    	    mysqli_query($DB, "update zamowienie set id_transakcji='".$id_transakcji."', etap_id=6 where id=".$id_zam);
//$bufor .= mysqli_error($DB)."\n";
            return false;
        }
    }
//$bufor .= "potwierdzenie transakcji\n";

    mysqli_query($DB, "update zamowienie set id_transakcji='".$id_transakcji."', etap_id=5 where id=".$id_zam);
//$bufor .= mysqli_error($DB)."\n";

	// zmniejszenie stanu magazynowego
	
	$reszp = mysqli_query($DB, "select ilosc, plec, rodzaj_koszulki_id, rozmiar_id, kolor_id from zamowienie_pozycja where typ_towaru_id=1 and zamowienie_id=".$id_zam);
	while($wierszzp = mysqli_fetch_array($reszp)){
							
		$rest = mysqli_query($DB, "select id from towar where plec='".$wierszzp['plec']."' and rodzaj_koszulki_id=".$wierszzp['rodzaj_koszulki_id']." and rozmiar_id=".$wierszzp['rozmiar_id']." and kolor_id=".$wierszzp['kolor_id']);
		$wierszt = mysqli_fetch_array($rest);
		mysqli_query($DB, "update towar set stan_magazynowy=stan_magazynowy-".$wierszzp['ilosc']." where id=".$wierszt['id']);
	}
	
	$reszp = mysqli_query($DB, "select ilosc, typ_towaru_id from zamowienie_pozycja where typ_towaru_id>1 and zamowienie_id=".$id_zam);
	while($wierszzp = mysqli_fetch_array($reszp)){
							
		$rest = mysqli_query($DB, "select id from towar where typ_towaru_id=".$wierszzp['typ_towaru_id']);
		$wierszt = mysqli_fetch_array($rest);
		mysqli_query($DB, "update towar set stan_magazynowy=stan_magazynowy-".$wierszzp['ilosc']." where id=".$wierszt['id']);
	}	
	
	// faktura
	
	$resf = mysqli_query($DB, "select max(invoice) from zamowienie");
	if($wierszf = mysqli_fetch_array($resf)){
		$invoice = $wierszf[0]+1;
	}else{
		$invoice = 1;
	}
	
	mysqli_query($DB, "update zamowienie set invoice=".$invoice." where id=".$id_zam);

    // mail do klienta

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.emaillabs.net.pl';
    $mail->SMTPAuth = true;
    $mail->Username = '1.webska.smtp';
    $mail->Password = 'e2DLTbPo';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $res = mysqli_query($DB, "select j.servicemail, j.symbol, j.pozycja_symbolu from dict_jezyk j, zamowienie z where j.id=z.jezyk_id and z.id=".$id_zam);
    $wiersz = mysqli_fetch_array($res);

    $customerservicemail = $wiersz['servicemail'];

//$customerservicemail = 'dorota.kepa@gmail.com';

    $pozycja_symbolu = $wiersz['pozycja_symbolu'];
    $symbol = $wiersz['symbol'];

//$bufor .= "Mail do klienta. \$customerservicemail: ".$customerservicemail."\n";
//$bufor .= "Mail do klienta. \$pozycja_symbolu: ".$pozycja_symbolu."\n";
//$bufor .= "Mail do klienta. \$symbol: ".$symbol."\n";


    $res = mysqli_query($DB, "select j.skrot, z.hasz, z.odbiorca_id, z.imie_zam, z.nazwisko_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, z.email_zam, k.nazwa as kraj_zam, z.koszt_wysylki_kwota, z.rabat_kwota, z.wartosc_kwota, tp.nazwa as typ_platnosci from zamowienie z, dict_kraj k, dict_typ_platnosci tp, dict_jezyk j where z.jezyk_id=j.id and z.kraj_zam_id=k.id and tp.id=z.typ_platnosci_id and z.id=".$id_zam);
    $wiersz = mysqli_fetch_array($res);

    $skrot = $wiersz['skrot'];
    
    if(is_file('./locales/'.$skrot.'/translation.json')){
        $sciezka = './locales/'.$skrot.'/szablony';
    }else if(is_file('../locales/'.$skrot.'/translation.json')){
        $sciezka = '../locales/'.$skrot.'/szablony';
    }else if(is_file('../../locales/'.$skrot.'/translation.json')){
        $sciezka = '../../locales/'.$skrot.'/szablony';
    }else if(is_file('../../../locales/'.$skrot.'/translation.json')){
        $sciezka = '../../../locales/'.$skrot.'/szablony';
    }
	
    $tlumaczenie=file_get_contents($_LANG_PATH.'/locales/'.$skrot.'/translation.json');
	$txt=json_decode($tlumaczenie);

//$bufor .= "Mail do klienta. \$sciezka: ".$sciezka."\n";


    $id = $wiersz['hasz'];
    $email = $wiersz['email_zam'];

    $imie_zam = $wiersz['imie_zam'];
    $nazwisko_zam = $wiersz['nazwisko_zam'];
    $adres1_zam = $wiersz['adres1_zam'];
    $kod_pocztowy_zam = $wiersz['kod_pocztowy_zam'];
    $miasto_zam = $wiersz['miasto_zam'];
    $kraj_zam = $wiersz['kraj_zam'];

//$bufor .= "Mail do klienta. \$imie_zam: ".$imie_zam."\n";
//$bufor .= "Mail do klienta. \$nazwisko_zam: ".$nazwisko_zam."\n";
//$bufor .= "Mail do klienta. \$adres1_zam: ".$adres1_zam."\n";
//$bufor .= "Mail do klienta. \$kod_pocztowy_zam: ".$kod_pocztowy_zam."\n";
//$bufor .= "Mail do klienta. \$miasto_zam: ".$miasto_zam."\n";
//$bufor .= "Mail do klienta. \$kraj_zam: ".$kraj_zam."\n";
    //$cena_powloki = 'h';

    //$koszt_wysylki_str = dodaj_walute($wiersz['koszt_wysylki_kwota'], $symbol, $pozycja_symbolu);
//$bufor .= "Mail do klienta. \$koszt_wysylki_str: ".$koszt_wysylki_str."\n";
    if($wiersz['rabat_kwota']!=0){
	$rabat_str = dodaj_walute($wiersz['rabat_kwota'], $symbol, $pozycja_symbolu);
	$rabat_str = '<span style="font-weight:bold;">Rabat: '.$rabat_str.'</span><br/><br/>';
    }else{
	$rabat_str = '';
    }
//$bufor .= "Mail do klienta. \$rabat_str: ".$rabat_str."\n";
    $razem_str = dodaj_walute($wiersz['wartosc_kwota'], $symbol, $pozycja_symbolu);
//$bufor .= "Mail do klienta. \$razem_str: ".$razem_str."\n";
    $forma_platnosci = $txt->{'baza'}->{$wiersz['typ_platnosci']};
//$bufor .= "Mail do klienta. \$forma_platnosci: ".$forma_platnosci."\n";

    $odbiorca_id = $wiersz['odbiorca_id'];

    if($odbiorca_id != ''){
	$res_o = mysqli_query($DB, "select z.imie_odb, z.nazwisko_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, k.nazwa as kraj_odb from zamowienie z, dict_kraj k where z.kraj_odb_id=k.id and z.id=".$id_zam);
	$wiersz_o = mysqli_fetch_array($res_o);
	
	$imie_odb = $wiersz_o['imie_odb'];
	$nazwisko_odb = $wiersz_o['nazwisko_odb'];
	$adres1_odb = $wiersz_o['adres1_odb'];
	$kod_pocztowy_odb = $wiersz_o['kod_pocztowy_odb'];
	$miasto_odb = $wiersz_o['miasto_odb'];
	$kraj_odb = $wiersz_o['kraj_odb'];

    }else{
	$imie_odb = $wiersz['imie_zam'];
	$nazwisko_odb = $wiersz['nazwisko_zam'];
	$adres1_odb = $wiersz['adres1_zam'];
	$kod_pocztowy_odb = $wiersz['kod_pocztowy_zam'];
	$miasto_odb = $wiersz['miasto_zam'];
	$kraj_odb = $wiersz['kraj_zam'];
    
    }
//$bufor .= "Mail do klienta. \$imie_odb: ".$imie_odb."\n";
//$bufor .= "Mail do klienta. \$nazwisko_odb: ".$nazwisko_odb."\n";
//$bufor .= "Mail do klienta. \$adres1_odb: ".$adres1_odb."\n";
//$bufor .= "Mail do klienta. \$kod_pocztowy_odb: ".$kod_pocztowy_odb."\n";
//$bufor .= "Mail do klienta. \$miasto_odb: ".$miasto_odb."\n";
//$bufor .= "Mail do klienta. \$kraj_odb: ".$kraj_odb."\n";

    $admin_link = "";

    $tytul = $txt->{'mail'}->{"potwierdzono_platnosc"};

//$bufor .= "Mail do klienta. \$email: ".$email."\n";

    $mail->setFrom($customerservicemail, 'LVADshirt.com');
    $mail->addReplyTo($customerservicemail, 'LVADshirt.com');
    $mail->addAddress($email, $imie_zam.' '.$nazwisko_zam);
    $mail->Subject = $tytul;

    $message1 = file_get_contents($sciezka.'/po_platnosci1.html');
//$bufor .= "Mail do klienta. \$message1: ".$message1."\n"; 

    
    $pattern = '/##\$([a-z|A-Z|0-9|_]+)##/';
    preg_match_all($pattern, $message1, $matches);
    
    for($i=0; $i < count($matches[0]); $i++){
	$miejsce = $matches[0][$i];
	$nazwa_zmiennej = $matches[1][$i];
	$zmienna = ${$nazwa_zmiennej};
	$message1 = str_replace($miejsce, $zmienna, $message1);
    }

	$query1 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, zp.plec, rk.nazwa as rodzaj, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from zamowienie_pozycja zp, dict_rodzaj_koszulki rk, dict_kolor k, dict_rozmiar r where zp.typ_towaru_id=1 and zp.kolor_id=k.id and zp.rozmiar_id=r.id and zp.rodzaj_koszulki_id=rk.id and zp.zamowienie_id=".$id_zam;
	$query2 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, NULL as plec, NULL as rodzaj, NULL as skrot, NULL as rozmiar, NULL as kolor from zamowienie_pozycja zp where zp.typ_towaru_id>1 and zp.zamowienie_id=".$id_zam;
	
    $res_zp = mysqli_query($DB, $query1." UNION ".$query2);

    $message2 = '';
    while($wiersz_zp = mysqli_fetch_array($res_zp)){
	
	$cena_str = dodaj_walute($wiersz_zp['cena']*$wiersz_zp['ilosc'], $symbol, $pozycja_symbolu);
	$ilosc = $wiersz_zp['ilosc'];

	$res_tt = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wiersz_zp['typ_towaru_id']);
	$wiersz_tt = mysqli_fetch_array($res_tt);
	
	if($wiersz_zp['typ_towaru_id'] > 1){
		$nazwa_towaru = $txt->{'baza'}->{$wiersz_tt['nazwa']}->{'nazwa'};
	}else{
		if($wiersz_zp['plec'] == "k"){
			$plec = "kobieta";
		}else{
			$plec = "mezczyzna";
		}
		$rodzaj = $wiersz_zp['rodzaj'];
		$rozmiar = $wiersz_zp['rozmiar'];
		$kolor = $wiersz_zp['kolor'];		
		$nazwa_towaru = $txt->{'baza'}->{$wiersz_tt['nazwa']}->{'nazwa'}.' '.$txt->{'baza'}->{$wiersz_zp['rodzaj']}.', '.$txt->{'baza'}->{$plec}.', '.$txt->{'baza'}->{'rozmiary'}->{'calosc'}->{$wiersz_zp['rozmiar']}.', '.$txt->{'mail'}->{'kolor'}.' '.$txt->{'baza'}->{$wiersz_zp['kolor']};
	}	
	
	
	$message2rob = file_get_contents($sciezka.'/po_platnosci2.html');
    
	preg_match_all($pattern, $message2rob, $matches);

	for($i=0; $i < count($matches[0]); $i++){
	    $miejsce = $matches[0][$i];
	    $nazwa_zmiennej = $matches[1][$i];
	    $zmienna = ${$nazwa_zmiennej};
	    $message2rob = str_replace($miejsce, $zmienna, $message2rob);
	}
	
	$message2 .= $message2rob;
    }
//$bufor .= "Mail do klienta. \$message2: ".$message2."\n"; 

    $message3 = file_get_contents($sciezka.'/po_platnosci3.html');

//$bufor .= "Mail do klienta. \$message3: ".$message3."\n"; 
    
    preg_match_all($pattern, $message3, $matches);

	for($i=0; $i < count($matches[0]); $i++){
	    $miejsce = $matches[0][$i];
	    $nazwa_zmiennej = $matches[1][$i];
	    $zmienna = ${$nazwa_zmiennej};
	    $message3 = str_replace($miejsce, $zmienna, $message3);
	}

    
    $message = $message1.$message2.$message3;
//$bufor .= "Mail do klienta. \$message: ".$message."\n"; 
    
    $mail->msgHTML($message, $sciezka);
    $mail->addAttachment('mail20160510-2.gif');
    $mail->addAttachment('mail20160510-2.gif'); 
    $mail->addAttachment('mail20160510-2.gif');

    $res_ebay = mysqli_query($DB, "select id from zamowienie where id=$id_zam and ebay_order_id != ''");
    $wiersz_ebay = mysqli_fetch_array($res_ebay);
    $is_ebay = $wiersz_ebay['id'];

    if($is_ebay){

	if (!$mail->send()) {
	    //$bufor .= "Mail do klienta. Mailer Error: " . $mail->ErrorInfo."\n";
	}else{
	    //$bufor .= "Mail do klienta ok";
	}

    }

    // mail do sklepu

    $admin_link = "http://".$_SERV.$_PATH."/admin.html";

    $message3 = file_get_contents($sciezka.'/po_platnosci3.html');
    
    preg_match_all($pattern, $message3, $matches);

	for($i=0; $i < count($matches[0]); $i++){
	    $miejsce = $matches[0][$i];
	    $nazwa_zmiennej = $matches[1][$i];
	    $zmienna = ${$nazwa_zmiennej};
	    $message3 = str_replace($miejsce, $zmienna, $message3);
	}

    
    $message = $message1.$message2.$message3;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.emaillabs.net.pl';
    $mail->SMTPAuth = true;
    $mail->Username = '1.webska.smtp';
    $mail->Password = 'e2DLTbPo';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

//$bufor .= "Mail do sklepu. \$customerservicemail: ".$customerservicemail."\n"; 

    $mail->setFrom($customerservicemail, 'LVADshirt.com');
    $mail->addReplyTo($customerservicemail, 'LVADshirt.com');
    $mail->addAddress($customerservicemail, 'LVADshirt.com');
    $mail->Subject = $tytul;

//$bufor .= "Mail do sklepu. \$message: ".$message."\n"; 

    $mail->msgHTML($message, $sciezka);
    $mail->addAttachment('mail20160510-2.gif');
    $mail->addAttachment('mail20160510-2.gif'); 
    $mail->addAttachment('mail20160510-2.gif');


    if (!$mail->send()) {
	//$bufor .= "Mail do sklepu. Mailer Error: " . $mail->ErrorInfo."\n";
    }else{
	//$bufor .= "Mail do sklepu ok\n";
    }
	
	//marketing
	
	mysqli_query($DB, "update marketing set zakup=1 where email='".$email."'");
	
	// koniec marketing
	
	//$sciezkab = '/home/klient.dhosting.pl/webska/lvadshirt.com/tmp/weryfikacja.log';
	//file_put_contents($sciezkab, $bufor, FILE_APPEND);
	
    return true;

}

function znajdz_obrazek($wybrany_rodzaj_koszulki, $wybrana_plec, $wybrany_kolor){

    if($wybrana_plec == 'k' && $wybrany_kolor == 1){
	$nr = 1;
    }elseif($wybrana_plec == 'k' && $wybrany_kolor == 2){
	$nr = 6;
    }elseif($wybrana_plec == 'm' && $wybrany_kolor == 1 && $wybrany_rodzaj_koszulki == 1){
	$nr = 5;
    }elseif($wybrana_plec == 'm' && $wybrany_kolor == 2 && $wybrany_rodzaj_koszulki == 1){
	$nr = 4;
    }elseif($wybrana_plec == 'm' && $wybrany_kolor == 1 && $wybrany_rodzaj_koszulki == 2){
	$nr = 3;
    }elseif($wybrana_plec == 'm' && $wybrany_kolor == 2 && $wybrany_rodzaj_koszulki == 2){
	$nr = 2;
    }
    return 'obrazek-produkt-n'.$nr.'.jpg';

}

function dodaj_walute($cena, $waluta, $pozycja){
    $cena = '<span class="wartosc">'.$cena.'</span>';
    if($pozycja == 0){
	$wynik = $waluta.' '.$cena;
    }else{
	$wynik = $cena.' '.$waluta;
    }
    return $wynik;
}

function dodaj_walute_f($cena, $waluta, $pozycja){
	if((($cena * 100)%10 ==0) && ($cena != 0)){
		$cena .= '0';
	}
    if($pozycja == 0){
	$wynik = $waluta.' '.$cena;
    }else{
	$wynik = $cena.' '.$waluta;
    }
    return $wynik;
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s',
        '/<!--(.|\s)*?-->/'
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}
ob_start("sanitize_output");
?>