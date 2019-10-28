<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try{
	$mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->Username = 'Administrator';
    $mail->Password = 'Kilud123';
    $mail->Port = 587;
	
	$mail->setFrom('noreply@bonewinged.tk');
    $mail->addAddress('karl32123@gmail.com');
	
	$mail->isHTML(true); 
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

}catch (Exception $e){
	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>