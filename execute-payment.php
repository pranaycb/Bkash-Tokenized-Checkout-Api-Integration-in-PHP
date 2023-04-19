<?php

include_once "./config.php";

$curl = curl_init();

$data = json_encode([
  "paymentID" => $_GET['paymentID'],
]);

curl_setopt_array($curl, [
  CURLOPT_URL => BASEURL . "/tokenized/checkout/execute",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "Authorization: ".$_SESSION['id_token'],
    "X-APP-Key: ".APPKEY,
    "accept: application/json",
    "content-type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {

  echo "cURL Error #:" . $err;

} else {

  $response = json_decode($response);

  header("location: status.php?trxID=".$response->trxID);

  echo "<pre>";
  echo $response;
  echo "</pre>";
}