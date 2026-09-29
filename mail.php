<?php
function Send_Mail($name, $email, $hash) {
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	require 'PHPMailer/Exception.php';
	$address_site = "http://p97754yb.beget.tech/07";
	$title = "ТЕСТ";
	$body = "
	<h2>Новое письмо</h2>
	<b>Здравствуйте</b> $name<br>
	<b>Сегодня вы зарегестрировались на сайте $address_site, если это были не вы игнорируйте данное письмо. Для подтверждения электронной почты пройдите по <a href=$address_site/activation.php?hash=$hash&email=$email> $address_site/activation.php?hash=$hash&email=$email ссылке.</a>";
	$mail = new PHPMailer\PHPMailer\PHPMailer();
	try {
		$mail->isSMTP();   
		$mail->CharSet = "UTF-8";
		$mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
		$mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

        // Настройки вашей почты
		$mail->Host = 'ssl://smtp.mail.ru';
		$mail->Port = 465;
		$mail->Username = 'mapol777@mail.ru';
    $mail->Password = '6ZqZ626adEeUcrxxJvus'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->setFrom('mapol777@mail.ru', 'MK'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress($email);  
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    
    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}
    
} catch (Exception $e) {
	$result = "error";
	$status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

    // Отображение результата
if (!isset($result)  )
	echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
}
function Send_Mail2($email, $pass) {
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	require 'PHPMailer/Exception.php';
	$address_site = "http://p97754yb.beget.tech/07";
	$title = "Восстановление пароля";
	$body = "
	<h2>Новое письмо</h2>
	<b>Здравствуйте</b><br>
	<b>Ваш новый пароль на сайте $address_site: $pass.";
	$mail = new PHPMailer\PHPMailer\PHPMailer();
	try {
		$mail->isSMTP();   
		$mail->CharSet = "UTF-8";
		$mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
		$mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

        // Настройки вашей почты
		$mail->Host = 'ssl://smtp.mail.ru';
		$mail->Port = 465;
		$mail->Username = 'mapol777@mail.ru';
    $mail->Password = 'dragonlaytdetka777'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->setFrom('mapol777@mail.ru', 'MK'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress($email);  
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    
    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}
    
} catch (Exception $e) {
	$result = "error";
	$status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

    // Отображение результата
if (!isset($result)  )
	echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
}
?>