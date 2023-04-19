<?php

include_once "./config.php";

$_SESSION['id_token'] = null;

$post_token = array(
    'app_key' => APPKEY,
    'app_secret' => APPSECRET
);

$url = curl_init(BASEURL."/tokenized/checkout/token/grant");

$post_token = json_encode($post_token);

$header = array(
    'Content-Type: application/json',
    "username:".USERNAME,
    "password:".PASSWORD
);

curl_setopt($url, CURLOPT_HTTPHEADER, $header);
curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);

$result_data = curl_exec($url);

curl_close($url);

$response = json_decode($result_data, true);


if (array_key_exists('msg', $response)) {

    echo json_encode($response);
}

echo $_SESSION['id_token'] = $response['id_token'];

?>