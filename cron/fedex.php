<?php
require_once('./library/fedex-common.php');
include('../include/lib.inc.php');
include('../include/config.inc.php');
include('../include/settings.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function CustomFedexMail($trackingNum){
$path_to_wsdl = "/home/klient.dhosting.pl/webska/lvadshirt.com/cron/wsdl/TrackService_v14.wsdl";
ini_set("soap.wsdl_cache_enabled", "0");
$client = new SoapClient($path_to_wsdl, array('trace' => 1));
$request['WebAuthenticationDetail'] = array(
	'UserCredential' => array(
	'Key' => 'liIIChQca2NBxvUp',
	'Password' => 'Y4svSJSEaWHJXjh9brNMaboZr'
	)
);
$request['ClientDetail'] = array(
	'AccountNumber' => '883910494',
	'MeterNumber' => '111766045'
);
$request['TransactionDetail'] = array('CustomerTransactionId' => '*** Track Request using PHP ***');
$request['Version'] = array(
	'ServiceId' => 'trck',
	'Major' => '14',
	'Intermediate' => '0',
	'Minor' => '0'
);
$request['SelectionDetails'] = array(
	'PackageIdentifier' => array(
		'Type' => 'TRACKING_NUMBER_OR_DOORTAG',
		'Value' => $trackingNum
	)
					);

try {
    if(setEndpoint('changeEndpoint')){
	$newLocation = $client->__setLocation(setEndpoint('endpoint'));
    }
    $response = $client ->track($request);
    if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){
	if($response->HighestSeverity == 'SUCCESS' && $response->CompletedTrackDetails->HighestSeverity == 'SUCCESS'){
	     $response=$response->CompletedTrackDetails->TrackDetails->StatusDetail->Description;  
			return $response;

	}
        // printSuccess($client, $response);
    }
} catch (SoapFault $exception) {
    // printFault($exception, $client);
	}
}


$query = "SELECT z.id, z.nr_przesylki, d.skrot, z.imie_zam, z.nazwisko_zam, z.email_zam FROM zamowienie z, dict_jezyk d WHERE z.jezyk_id=d.id AND dostawa=2 AND nr_przesylki IS NOT NULL";
$result = mysqli_query($DB, $query);

if(mysqli_num_rows($result)==0){
print "Affected rows: ". mysqli_affected_rows($DB)."<br>";
}

while($wiersz = mysqli_fetch_array($result)){
	$tlumaczenie=file_get_contents($_LANG_PATH.'/locales/'.$wiersz['skrot'].'/translation.json');
	$txt=json_decode($tlumaczenie);
	$imie_zam=$wiersz['imie_zam'];
	$nazwisko_zam=$wiersz['nazwisko_zam'];
	$nr_przesylki=$wiersz['nr_przesylki'];

	$sciezka = '../locales/'.$wiersz['skrot'].'/szablony';
    print $wiersz['nr_przesylki']. ' - '.$wiersz['id'].' - '.$wiersz['skrot'].' - '.$wiersz['email_zam'].'<br>';
	$fdx= CustomFedexMail($nr_przesylki);
	echo  "Fedex satus:".$fdx. "<br>";
	if(isset($fdx)){
		if($fdx=='Delivered'){

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

					$pattern = '/##\$([a-z|A-Z|0-9|_]+)##/';
					$message=file_get_contents($sciezka.'/czy-koszulka-dotarlaOK.html');
					preg_match_all($pattern, $message, $matches);

				 	for($i=0; $i < count($matches[0]); $i++){
						$miejsce = $matches[0][$i];
						$nazwa_zmiennej = $matches[1][$i];
						$zmienna = ${$nazwa_zmiennej};
						$message = str_replace($miejsce, $zmienna, $message);
				    }
					//uncomment in case of deployment
					//$query_2 = "UPDATE zamowienie SET dostawa=1 WHERE id=".$wiersz['id'];
					//mysqli_query($DB, $query_2);

					$email=$wiersz['email_zam'];
					$tytul=$txt->{'mail'}->{'Fedex'};
				 	$mail->setFrom($customerservicemail, 'LVADshirt.com');
				    $mail->addReplyTo($customerservicemail, 'LVADshirt.com');
				    $mail->addAddress($email, $imie_zam.' '.$nazwisko_zam);
				    $mail->Subject = $tytul;
				    $mail->msgHTML($message, $sciezka);
					unset($email);

				    if (!$mail->send()) {
						echo "Mailer Error: " .$mail->ErrorInfo."<br>";
				    } else {
						echo "Mailer response OK<br>";
				    }
		}else {
			echo "Mail nie wysylamy<br>";
		}
	}else{
	echo"Problem z API FedEx'a<br>";	
	}
echo"---------------------koniec------------------<br>";

}


?>
