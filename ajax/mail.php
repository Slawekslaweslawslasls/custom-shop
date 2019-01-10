<?php
//error_reporting(0);
include('../include/settings.inc.php');
include('../include/lib.inc.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

##Inicjalizacja klasy
$mail = new PHPMailer;

##Ustawienia danych połączenia SMTP
$mail->isSMTP();
$mail->Host = 'smtp.emaillabs.net.pl';
$mail->SMTPAuth = true;
$mail->Username = '1.webska.smtp';
$mail->Password = 'e2DLTbPo';
$mail->Port = 587;
$mail->CharSet = 'UTF-8';

$sciezka = '../locales/'.$lang.'/szablony';

$akcja = $_POST['akcja'];

if($akcja == "kontakt"){
    
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $message = $_POST['mail'];
	$nagranie = $_POST['nagranie'];

	// marketing

	$_SESSION['email'] = $email;
	
	list($im, $naz) = explode(' ', $nazwisko);
	$im = trim($im);
	$naz = trim($naz);
	
	$resj = mysqli_query($DB, "select id from dict_jezyk where skrot='".$lang."'");
	$wierszj = mysqli_fetch_array($resj);
	$jezyk_id = $wierszj['id'];
	
	$ip = getUserIP();
	
	$resm = mysqli_query($DB,"select email from marketing where email = '".$email."'");
	$ilem = mysqli_num_rows($resm);
	if($ilem == 0){
		mysqli_query($DB, "insert into marketing (email, imie, nazwisko, ip, jezyk, data_wprowadzenia, data_modyfikacji) values ('".$email."','".$im."','".$naz."', '".$ip."', ".$jezyk_id.", NOW(), NOW())");
	}else{
		mysqli_query($DB, "update marketing set imie='".$im."', nazwisko='".$naz."' ,jezyk=".$jezyk_id.", data_modyfikacji=NOW() where email='".$email."'");
		mysqli_query($DB, "update marketing set ip='".$ip."', data_modyfikacji=NOW() where email='".$email."' and zgoda=0");
	}

	// koniec marketing
	
	// wysylanie
	/*
    $tytul = $txt->{'mail'}->{'wiadomosc_ze_strony_kontakt'};
    $tytul = '=?utf-8?B?'.base64_encode($tytul).'?=';

	$tresc = $txt->{'mail'}->{'imie_i_nazwisko'}.': '.$imie.' '.$nazwisko.'<br/>';
	if($email != ''){
	$tresc .= $txt->{'mail'}->{'email'}.': '.$email.'<br/>';
    }
    if($tel != ''){
	$tresc .= $txt->{'mail'}->{'telefon'}.': '.$tel.'<br/>';
    }
	$tresc .= 'Smartlook: '.$nagranie.'<br/>';
    $tresc .= $txt->{'mail'}->{'tresc_wiadomosci'}.': <br/>';
    $tresc .= $message;
	*/
	
    $tytul = "Wiadomość ze strony LVADshirt.com";
    $tytul = '=?utf-8?B?'.base64_encode($tytul).'?=';

	$tresc = "Imię i nazwisko".': '.$imie.' '.$nazwisko.'<br/>';
	if($email != ''){
	$tresc .= "Email".': '.$email.'<br/>';
    }
    if($tel != ''){
	$tresc .= "Telefon".': '.$tel.'<br/>';
    }
	$tresc .= 'Smartlook: '.$nagranie.'<br/>';
    $tresc .= "Treść wiadomosci".': <br/>';
    $tresc .= $message;
	
	
//$customerservicemail = 'dorota.kepa@gmail.com';

    //$mail->setFrom($customerservicemail, 'LVADshirt.com');
    $mail->setFrom($email, $nazwisko);
    $mail->addReplyTo($email, $nazwisko);
    $mail->addAddress($customerservicemail, 'LVADshirt.com');

    
    $mail->Subject = $tytul;
    $mail->msgHTML($tresc);

    if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
	echo "ok";
    }

}elseif($akcja == "zlozenie"){
 // do klienta
    $id_zam = $_POST['id_zam'];
    $typ_platnosci = $_POST['typ_platnosci'];
    $res = mysqli_query($DB, "select z.hasz, z.odbiorca_id, z.imie_zam, z.nazwisko_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, z.email_zam, k.nazwa as kraj_zam, z.koszt_wysylki_kwota, z.rabat_kwota, z.wartosc_kwota, tp.nazwa as typ_platnosci from zamowienie z, dict_kraj k, dict_typ_platnosci tp where z.kraj_zam_id=k.id and tp.id=".$typ_platnosci." and z.id=".$id_zam);
    $wiersz = mysqli_fetch_array($res);
    $id = $wiersz['hasz'];
    $email = $wiersz['email_zam'];
    
    $imie_zam = $wiersz['imie_zam'];
    $nazwisko_zam = $wiersz['nazwisko_zam'];
    $adres1_zam = $wiersz['adres1_zam'];
    $kod_pocztowy_zam = $wiersz['kod_pocztowy_zam'];
    $miasto_zam = $wiersz['miasto_zam'];
    $kraj_zam = $wiersz['kraj_zam'];

    $koszt_wysylki_str = dodaj_walute($wiersz['koszt_wysylki_kwota'], $waluta, $pozycja_symbolu);
    if($wiersz['rabat_kwota'] != 0){
	$rabat_str = dodaj_walute($wiersz['rabat_kwota'], $waluta, $pozycja_symbolu);
	$rabat_str = '<span style="font-weight:bold;">Rabat: '.$rabat_str.'</span><br/><br/>';
    }
    $razem_str = dodaj_walute($wiersz['wartosc_kwota'], $waluta, $pozycja_symbolu);
    $forma_platnosci = $txt->{'baza'}->{$wiersz['typ_platnosci']};

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


    $tytul = $txt->{'mail'}->{'nowe_zamowienie'};
    $payment_link = "http://".$_SERV.$_PATH."/platnosc.html?id=".$id;

//$customerservicemail = 'dorota.kepa@gmail.com';

    $mail->setFrom($customerservicemail, 'LVADshirt.com');
    $mail->addReplyTo($customerservicemail, 'LVADshirt.com');
    $mail->addAddress($email, $imie_zam.' '.$nazwisko_zam);
    $mail->Subject = $tytul;

    $message1 = file_get_contents($sciezka.'/po_zamowieniu1.html');
    
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
	
	$cena_str = dodaj_walute($wiersz_zp['cena']*$wiersz_zp['ilosc'], $waluta, $pozycja_symbolu);
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
	
	$message2rob = file_get_contents($sciezka.'/po_zamowieniu2.html');
    
	preg_match_all($pattern, $message2rob, $matches);

	for($i=0; $i < count($matches[0]); $i++){
	    $miejsce = $matches[0][$i];
	    $nazwa_zmiennej = $matches[1][$i];
	    $zmienna = ${$nazwa_zmiennej};
	    $message2rob = str_replace($miejsce, $zmienna, $message2rob);
	}
	
	$message2 .= $message2rob;
    }

    $message3 = file_get_contents($sciezka.'/po_zamowieniu3.html');
    
    preg_match_all($pattern, $message3, $matches);

	for($i=0; $i < count($matches[0]); $i++){
	    $miejsce = $matches[0][$i];
	    $nazwa_zmiennej = $matches[1][$i];
	    $zmienna = ${$nazwa_zmiennej};
	    $message3 = str_replace($miejsce, $zmienna, $message3);
	}
    
    
    $message = $message1.$message2.$message3;
    
    $mail->msgHTML($message, $sciezka);
    $mail->addAttachment('mail20160510-2.gif');
    $mail->addAttachment('mail20160510-2.gif'); 
    $mail->addAttachment('mail20160510-2.gif');
    $mail->addAttachment($sciezka.'/'.$txt->{'zalaczniki'}->{'zal_odstapienie'}.'.pdf');
    $mail->addAttachment($sciezka.'/'.$txt->{'zalaczniki'}->{'zal_regulamin'}.'.pdf');

    if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
	echo "ok";
    }
}


elseif($akcja == "walidacja_email"){
		if (isset($_POST['email'])){
			$email=$_POST['email'];
			//include('../mailing/mverify.php');
			$domain = substr($email, strrpos($email, '@') + 1);
			if(checkdnsrr($domain,'MX')){
				echo 1;
			}
			else{
				echo 0;
			}

		}
}elseif($akcja == "rabat_wysylka"){
	
	if (isset($_POST['email'])){
		$email=$_POST['email'];
		if($message=file_get_contents('../locales/'.$lang.'/szablony/kod-rabatowyOK.html')){

			/*generate rabat code*/
			function shuffleRabat(){
				$seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
				$seed1=array_rand($seed,6);
	      		foreach ($seed1 as $key => $value) {
	        		$rabatCode[$key]=$seed[$value];
	      		}
				return implode("",$rabatCode);
			}

			/*make comparission and record to db*/
			$res = mysqli_query($DB, "SELECT DISTINCT kod FROM kod_rabatowy");
			$rabatCode=shuffleRabat();
	      		while($wiersz = mysqli_fetch_array($res)){
		      			if($rabatCode==$wiersz['kod']){
		      				$rabatCode=shuffleRabat();
		      			}
	      		}

			$dateEnd=Date($txt->{'mailsettings'}->{'mail'}, strtotime("+14 days"));

	      	$res2=mysqli_query($DB, "INSERT INTO kod_rabatowy (kod, wykorzystany, jednorazowy, rabat_id, data, jezyk_id) VALUES ('".$rabatCode."', 0 , 1, 3, '".$dateEnd."',(SELECT dict_jezyk.id FROM dict_jezyk WHERE dict_jezyk.skrot='".$lang."'))" );

			

	      	$pattern = '/##\$([a-z|A-Z|0-9|_]+)##/';
			preg_match_all($pattern, $message, $matches);
			for($i=0; $i < count($matches[0]); $i++){
						$miejsce = $matches[0][$i];
						$nazwa_zmiennej = $matches[1][$i];
						$zmienna = ${$nazwa_zmiennej};
						$message = str_replace($miejsce, $zmienna, $message);
			}

			/*wysylka maila*/
			$tytul=$txt->{'mail'}->{'Rabat'};
			$mail->setFrom($customerservicemail, 'LVADshirt.com');
			$mail->addReplyTo($customerservicemail, 'LVADshirt.com');
		    $mail->addAddress($email); 
		    $mail->Subject = $tytul;
		    $mail->msgHTML($message);
			unset($email);
		    if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		    } else {
			echo "ok";
		    }
		unset($rabatCode);
}
}
}

?>




