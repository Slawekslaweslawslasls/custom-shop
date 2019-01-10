<?php
include('../include/lib.inc.php');
include('../include/config.inc.php');
include_once('../PHPMailer/PHPMailerAutoload.php');
$DB = mysqli_connect($_DBHOST,$_DBUSER,$_DBPASS);
mysqli_select_db($DB, $_DBNAME);
mysqli_set_charset($DB,"utf8");
$mc_gross=$_POST['mc_gross'];
$mc_currency=$_POST['mc_currency'];
$payer_id=$_POST['payer_id'];
$payment_status=$_POST['payment_status'];
$receiver_id=$_POST['receiver_id'];
$receiver_email=$_POST['receiver_email'];
$item_number=$_POST['item_number'];
$residence_country=$_POST['residence_country'];
$test_ipn=$_POST['test_ipn'];
$txn_id=$_POST['txn_id'];
$custom=$_POST['custom'];

$bufor = "DATA: ".date("d-m-Y H:i:s").", IP: ".$_SERVER['REMOTE_ADDR']."\n";
$bufor .= '$mc_gross: '.$mc_gross."\n";
$bufor .= '$mc_currency: '.$mc_currency."\n";
$bufor .= '$payer_id: '.$payer_id."\n";
$bufor .= '$payment_status: '.$payment_status."\n";
$bufor .= '$receiver_id: '.$receiver_id."\n";
$bufor .= '$receiver_id: '.$receiver_email."\n";
$bufor .= '$item_number: '.$item_number."\n";
$bufor .= '$residence_country: '.$residence_country."\n";
$bufor .= '$test_ipn: '.$test_ipn."\n";
$bufor .= '$txn_id: '.$txn_id."\n";
$bufor .= '$custom: '.$custom."\n";

if($payment_status == 'Completed' && $receiver_id == 'B2C4LT6L9FJ32' && $receiver_email == 'customerservice@lvadshirt.com' && $test_ipn != 1){

$bufor .= "completed\n";

    $req='cmd=_notify-validate';
    foreach($_POST as $key => $value){
    $value=urlencode($value);
    $req .= "&$key=$value";
    }
    $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    $fp = fsockopen('www.paypal.com', 80, $errno, $errstr, 30);

$bufor .= '$errno: '.$errno."\n";
$bufor .= '$errstr: '.$errstr."\n";

    fputs($fp, $header . $req);
    while(!feof($fp)) {
    $res = fgets($fp, 1024);
    }

$bufor .= '$res: '.$res."\n";

    if($res == 'VERIFIED'){
    // zapisać:
    // $txn_id - identyfikator transkacji paypal
    // $custom - numer zamówienia
    // $mc_currency - waluta
    // $mc_gross - kwota
	if(weryfikacja_platnosci($custom,$mc_gross,$mc_currency,$txn_id)){
    	    $bufor .= 'weryfikacja_ok'."\n";
	}else{
	    $bufor .= 'weryfikacja_blad'."\n";
	}
    }

}
 $sciezkab = '/home/klient.dhosting.pl/webska/lvadshirt.com/tmp/paypal.log';
 file_put_contents($sciezkab, $bufor, FILE_APPEND);

?>