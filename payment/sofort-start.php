<?php
$username='160053';
$password='03fdaf318f1c4dfd895470c012252bf9';
$sofort_api='https://api.sofort.com/api/xml';
$project_id='410592';
$email='test@test.pl';
$amount='89.98';
$currency_code='EUR';
$name='Jan Kowalski';
$subject='LVADshirt order 123';
$xml='<?xml version="1.0" encoding="UTF-8" ?>
<multipay>
      <project_id>'.$project_id.'</project_id>
      <interface_version>LVADshirt.com/Sofort_0.1</interface_version>
      <language_code>DE</language_code>
      <email_customer>'.$email.'</email_customer>
      <amount>'.$amount.'</amount>
      <currency_code>'.$currency_code.'</currency_code>
      <beneficiary>
         <identifier>'.$name.'</identifier>
         <country_code>DE</country_code>
      </beneficiary>
      <reasons>
            <reason>'.$subject.'</reason>
      </reasons>
      <success_url>https://www.lvadshirt.com/zamowienie.html</success_url>
      <success_link_redirect>1</success_link_redirect>
      <abort_url>https://www.lvadshirt.com/anulowanie.html</abort_url>
      <notification_urls>
            <notification_url>https://www.lvadshirt.com/payment/sofort.html</notification_url>
            <notification_url notify_on="received,loss">https://www.lvadshirt.com/payment/sofort.html</notification_url>
      </notification_urls>
      <su />
</multipay>';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sofort_api);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml', 'Content-length: ' . strlen($xml)));
$response = curl_exec($ch);
curl_close($ch);
$response=simplexml_load_string($response);
$transaction_id=$response->transaction;
$payment_url=$response->payment_url;
header('Location: '.$payment_url);
?>