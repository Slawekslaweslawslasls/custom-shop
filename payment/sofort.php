<?php
//https://www.sofort.com/integrationCenter-eng-DE/content/view/full/2513
$xml = trim(file_get_contents('php://input'));
$response=simplexml_load_string($xml);
$transaction=$response->transaction;
$username='160053';
$password='03fdaf318f1c4dfd895470c012252bf9';
$sofort_api='https://api.sofort.com/api/xml';
$xml='<?xml version="1.0" encoding="UTF-8" ?>
<transaction_request>
    <transaction>'.$transaction.'</transaction>
</transaction_request>';
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
$project_id=$response->transaction_details[0]->project_id;
$transaction=$response->transaction_details[0]->transaction;
file_put_contents('test.txt',$response);
echo 'OK';
?>