<?php
	$url = 'https://feed-red.com/api/SendMail/index.php';
	$data = [
        "to" => "rayidjeri@gmail.com",
        "host" => "smtp.gmail.com",
        "smtpsecure" => "tls",
        "port" => "587",
        "subject" => "Code de confirmation de compte",
        "message" => rand(10000, 99999)
    ];

	// utiliser 'http' même si vous envoyer des requêtes en https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'GET',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	echo '<pre>'; print_r($result);
?>