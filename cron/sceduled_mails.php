<?php
include('../include/config.inc.php');
include('../include/settings.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$query = "SELECT data FROM zamowienie";
$result = mysqli_query($DB, $query);
while($wiersz = mysqli_fetch_array($result)){
		$datetime1=$wiersz['data'];
		$datetime2=now();
		$interval = date_diff($datetime1, $datetime2);
}


?>