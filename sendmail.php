<?php

error_reporting(E_ALL);
ini_set('display_errors', '1'); //이거 php에러보는 거 확인하고 




/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

include "PHPMailer.php";
include "SMTP.php";
//include "Exception.php"; //이 주석 삭제 하고 

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

$mail->CharSet    = "utf-8";   //한글깨짐 방지

$mail->SMTPKeepAlive = true;

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.naver.com';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = 465;


//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure ="ssl";

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'ksy930613@naver.com';

//Password to use for SMTP authentication
$mail->Password = 'dododo112!!';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('ksy930613@naver.com', 'Frame 관리자');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
$mail->addReplyTo('ksy930613@naver.com', 'Frame 관리자');

//Set who the message is to be sent to 받는 사람 


//Set the subject line//메일 제목 
// $mail->Subject = 'Frame Check Mail';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

//Replace the plain text body with one created manually//메일 내용 
// $mail->Body = '메일 내용입니다.ㅁㄴㅇㄹ머;니어린'; // 얘를 AltBody->Body로 바꿔줌

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
// if (!$mail->send()) {
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message sent!';
// }

?>

