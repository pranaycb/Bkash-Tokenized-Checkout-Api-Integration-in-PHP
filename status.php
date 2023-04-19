<?php

include_once "./config.php";

$requestbody = array(
  'trxID' => $_GET['trxID']
);

$url=curl_init(BASEURL . '/tokenized/checkout/general/searchTransaction');
$header=array(
  'Content-Type:application/json',
  'authorization:'.$_SESSION['id_token'],
  'x-app-key:'.APPKEY
);

curl_setopt($url,CURLOPT_HTTPHEADER, $header);
curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($requestbody));
curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);

$resultdatax = curl_exec($url);

curl_close($url);

echo "<pre>";
print_r(json_decode($resultdatax));
echo "</pre>";

