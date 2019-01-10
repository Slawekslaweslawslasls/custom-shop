<?php
    include('../include/settings.inc.php');
    include('../include/lib.inc.php');

    include_once('./include/PayLaneRestClient.php');

    //$kwota_laczna = $_POST['kwota_laczna'];
    $kwota_laczna=$_SESSION['kwota_laczna'];
    //$kwota_laczna=settype($_SESSION['kwota_laczna'], "float");
    $rabat = $_POST['rabat'];
    $koszt_wysylki = $_POST['koszt_wysylki'];
    $numKarty=trim($_POST['numer_karty']);
    $numKarty=preg_replace('/\s+/', '', $numKarty);
    settype($numKarty,"string");
    $ip=getUserIP();

   
$bufor=PHP_EOL;
$bufor .= "DATA: ".date("d-m-Y H:i:s").", IP: ".$_SERVER['REMOTE_ADDR']."\n";	
$bufor .= "\$kwota_laczna: ".$kwota_laczna."\n";
$bufor .= "\$rabat: ".$rabat."\n";
$bufor .= "\$koszt_wysylki: ".$koszt_wysylki."\n";


    $query = "update zamowienie set wartosc_kwota=".$kwota_laczna.", ";
    $query .= "rabat_kwota=".$rabat.", koszt_wysylki_kwota=".$koszt_wysylki." where id=".$_SESSION['id_zam'];
    mysqli_query($DB, $query);

$bufor .= mysqli_error($DB)."\n";
$res = mysqli_query($DB, "select * from zamowienie where id=".$_SESSION['id_zam']);
$bufor .= mysqli_error($DB)."\n";

    $wiersz = mysqli_fetch_array($res);
    
    $tytul_zam = $txt->{'mail'}->{'zamowienienr'};

$bufor .= "\$wiersz[\'wojewodztwo_zam_id\']: ".$wiersz['wojewodztwo_zam_id']."\n";
    
    if($wiersz['wojewodztwo_zam_id'] != 0){
	$reswoj = mysqli_query($DB, "select nazwa, kod from dict_wojewodztwo where id=".$wiersz['wojewodztwo_zam_id']);

$bufor .= mysqli_error($DB)."\n";

	$wierszwoj = mysqli_fetch_array($reswoj);
	$wojewodztwo_zam = $wierszwoj['nazwa'];
	if($wierszwoj['kod'] != ''){$wojewodztwo_zam = $wierszwoj['kod'];}

    }else{
	$wojewodztwo_zam = 'none';
    }

    $resk = mysqli_query($DB, "select z.kraj_zam_id, k.kod from zamowienie z, dict_kraj k where z.kraj_zam_id=k.id and z.id=".$_SESSION['id_zam']);

$bufor .= mysqli_error($DB)."\n";

    $wierszk = mysqli_fetch_array($resk);
    $kraj_zam_id = $wierszk['kraj_zam_id'];
    $country_code = $wierszk['kod'];

$bufor .= "\$kraj_zam_id: ".$kraj_zam_id."\n";


$bufor .= "\$country_code: ".$country_code."\n";

    $mies = $_SESSION['mies'];
    if($_SESSION['mies'] < 10){
	//$mies ='0'.$mies; as i see month already in format "XX" so no need
    }

    if(strstr($wiersz['ip_zam'], ':')){
	$wiersz['ip_zam']='192.168.0.130';
    }



$kod_pocztowy_zam= preg_replace('/\D+/','',$wiersz['kod_pocztowy_zam']);



$bufor .= 'Nr karty: '.$_SESSION['nrk']."\n";
$bufor .= 'Mies: '.$mies."\n";
$bufor .= 'Rok: '.$_SESSION['rok']."\n";
$bufor .= 'CVV: '.$_SESSION['kwk']."\n";
$bufor .= "\$waluta_pp: ".$waluta_pp."\n";
$bufor .= "\$tytul_zam: ".$tytul_zam."\n";
$bufor .= "\$wiersz[\'id\']: ".$wiersz['id']."\n";
$bufor .= "\$wiersz[\'imie_zam\']: ".$wiersz['imie_zam']."\n";
$bufor .= "\$wiersz[\'nazwisko_zam\']: ".$wiersz['nazwisko_zam']."\n";
$bufor .= "\$wiersz[\'email_zam\']: ".$wiersz['email_zam']."\n";
$bufor .= "\$wiersz[\'ip_zam\']: ".$wiersz['ip_zam']."\n";
$bufor .= "\$wiersz[\'adres1_zam\']: ".$wiersz['adres1_zam']."\n";
$bufor .= "\$wiersz[\'miasto_zam\']: ".$wiersz['miasto_zam']."\n";
$bufor .= "\$wiersz[\'kod_pocztowy_zam\']: ".$wiersz['kod_pocztowy_zam']."\n";
$bufor .= "Wojewodztwo: ".$wojewodztwo_zam."\n";
//$bufor .= "\$_SESSION[\'nrk\']: ".$_SESSION['nrk']."\n";
//$bufor .= "\$_SESSION[\'rok\']: ".$_SESSION['rok']."\n";
//$bufor .= "\$_SESSION[\'wk\']: ".$_SESSION['wk']."\n";
//$bufor .= "\$_SESSION[\'kwk\']: ".$_SESSION['kwk']."\n";
$bufor.=PHP_EOL;
$bufor.="=======DANE KARTY (CARD_PARAMS) PRZYGOTOWANE DLA WYSYLKI========".PHP_EOL;
$bufor.="kwota_laczna= ".$kwota_laczna.PHP_EOL;
$bufor.="$waluta_pp= ".$waluta_pp.PHP_EOL;
$bufor.="$tytul_zam.$wiersz[id]= ". $tytul_zam.' '.$wiersz['id'].PHP_EOL;
$bufor.="$wiersz[imie_zam].$wiersz[nazwisko_zam]= ". $wiersz['imie_zam'].' '.$wiersz['nazwisko_zam'].PHP_EOL;
$bufor.="email= ".$wiersz['email_zam'].PHP_EOL;
$bufor.="ip= ".$ip.PHP_EOL;
$bufor.="street_house= ".$wiersz['adres1_zam'].PHP_EOL;
$bufor.="city= ".$wiersz['miasto_zam'].PHP_EOL;
$bufor.="state= ".$wojewodztwo_zam.PHP_EOL;
$bufor.="zip= ".$kod_pocztowy_zam.PHP_EOL;
$bufor.="country_code= ".$country_code.PHP_EOL;
$bufor.="card_number= ".$numKarty.PHP_EOL;
$bufor.="expiration_month= ".$mies.PHP_EOL;
$bufor.="expiration_year= " .$_SESSION['rok'].PHP_EOL;
$bufor.="name_on_card= ".$_SESSION['wk'].PHP_EOL;
$bufor.="card_code= ".$_SESSION['kwk'].PHP_EOL;
$bufor.="=======KONIEC DANE KARTY (CARD_PARAMS)========".PHP_EOL;
$bufor.=PHP_EOL;


$card_params = array(
    'sale'     => array(
        'amount'      => $kwota_laczna,
        'currency'    => $waluta_pp,
        'description' => $tytul_zam.' '.$wiersz['id'],
    ),
    'customer' => array(
        'name'    => $wiersz['imie_zam'].' '.$wiersz['nazwisko_zam'],
        'email'   => $wiersz['email_zam'],
        'ip'      => $ip,
        'address' => array (
            'street_house' => $wiersz['adres1_zam'],
            'city'         => $wiersz['miasto_zam'],
            'state'        => $wojewodztwo_zam,
            'zip'          => $kod_pocztowy_zam,
            'country_code' => $country_code,
        ),
    ),
    'card' => array(
	    'card_number' => $numKarty,
	    'expiration_month' => $mies,
	    'expiration_year' =>  $_SESSION['rok'],
	    'name_on_card' => $_SESSION['wk'],
	    'card_code' => $_SESSION['kwk'],
     ),
);

//ob_start();
//var_dump($card_params);
//$bufor .= "\$card_params: ".ob_get_clean();

    try{
    // login and password from there https://merchant.paylane.com/#/login
	$client = new PayLaneRestClient('956a4b23a16df5c743969f181ed8e73e', 'CU3#CRA1$THI4*ri');
	//$client = new PayLaneRestClient('webska', 'pq17Piotr!');
$bufor .= "karta polaczenie ok\n";
$status = $client->cardSale($card_params);
$bufor .= "karta sprzedaz ok\n";

    if ($client->isSuccess()) {

		//if(weryfikacja_platnosci((string)$_SESSION['id_zam'], $kwota_laczna, $waluta_pp, $status['id_sale'])){
		if(weryfikacja_platnosci((string)$_SESSION['id_zam'], NULL, NULL, $status['id_sale'])){
			echo "ok";
			$bufor .= "karta weryfikacja ok\n";
		}else{
			//echo "no";
			$bufor .= "karta weryfikacja no\n";
		}

    } else {
		mysqli_query($DB, "update zamowienie set etap_id=6, opis_transakcji='".$status['error']['error_description']."' where id=".$_SESSION['id_zam']);
	
		$bufor .= "Error ID: {$status['error']['id_error']}, \n".
        "Error number: {$status['error']['error_number']}, \n".
        "Error description: {$status['error']['error_description']}";
        echo $status['error']['error_description'];
	  
        
    }

    }catch(Exception $e){
        echo $e;
	//var_dump($e);
$bufor .= "karta wyjatek\n";
$bufor .= "wyjatek: ".implode(';', (array)$e);
    }

$sciezkab = '../tmp/karta.log';
file_put_contents($sciezkab, $bufor, FILE_APPEND);



?>