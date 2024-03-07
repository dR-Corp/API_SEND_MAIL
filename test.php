<?php

    include('api_mail.php');

    $to = "rayidjeri@gmail.com";
    $subject = "TEST TEST";
    $message = "TEST MESSAGE BODY";
    $attachement = "";

    // print_r($to);

    // $response = json_decode(api_mail($to, $subject, $message, ""));
    // print_r($response);

$url = 'https://api-send-mail-iota.vercel.app/';

$data = [
    "to" => $to,
    "subject" => $subject,
    "message" => $message,
    "attachement" => $attachement,
];

$options = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/json',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    die('Error getting response');
}

var_dump($response);