<?php
/**
 *settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
$date=date("dd:mm:yyyy");
$time=date("hh:mm:ss");
include("db.php");
require_once('PHPMailer/PHPMailerAutoload.php');
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
//$mail->isSMTP();
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "mercymutuku19@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "yourpassword";
//Set who the message is to be sent from
$mail->setFrom($email, $name);
//Set an alternative reply-to address
$mail->addReplyTo('mercymutuku19@gmail.com', 'Mercy Mutuku');
//Set who the message is to be sent to
$mail->addAddress('mercymutuku19@gmail.com', 'Mercy Mutuku');
//Set the subject line
$mail->Subject = 'Open questions';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = $message;
$mail->Body    = $message;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	$SQL = mysql_query("INSERT INTO tbl_messages VALUES ('', '$name', '$email', '$message') ");

  	echo "<script type='text/javascript'>alert('Your message has been sent. Thank you.'); window.location='index.html'</script>";
    //echo "Message sent!";
}