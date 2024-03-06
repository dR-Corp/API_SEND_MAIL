<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/Exception.php';

	// Connect to database
    // 	$request_method = $_SERVER["REQUEST_METHOD"];

    $data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = file_get_contents('php://input');
        parse_str($postData, $data);
    }

    extract($data);

    $from = 'mapaieup@gmail.com';
    $from_name = "MAPAIE - Universite de parakou";
    $secret = 'gokjgckmbckfucem';
    $host = 'smtp.gmail.com';
    $smtpsecure = 'tls';
    $port = '587';
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = $host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $from;
        $mail->Password   = $secret;
        $mail->SMTPSecure = $smtpsecure;
        $mail->Port       = $port;

        //Recipients
        $mail->setFrom($from, $from_name);
        $mail->addAddress($to, $to);
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        // $mail->Body    = $message;
        $mail->Body    = $message;
        // $mail->addAttachment($attachement);
        
        $mail->send();
        
        $response = [
            "status" => 1,
            "status_message" => "--MESSAGE ENVOYE AVEC SUCCES",
        ];

        // echo 'Message has been sent';
    } catch (Exception $e) {
        $response = [
            "status" => 0,
            "status_message" => "--LE MAIL NE PEUT ETRE ENVOYE. ERREUR : {$mail->ErrorInfo}",
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    echo json_encode($response, JSON_PRETTY_PRINT);
	
?>