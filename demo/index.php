<?php

echo " Psiii/Mailer/PostOffice";

error_reporting(E_ALL ^ E_NOTICE);

include './demo.config.php';
include '../vendor/autoload.php';

$spoolDir = dirname(__FILE__) . '/spool';
$mailSpoolSender = new \Psiii\Mailer\MailFileSpool($spoolDir);
$transporterGmail = new \Psiii\Mailer\TransporterGmail($psiiiMailer['gmail']['username'], $psiiiMailer['gmail']['password']);

$postOffice = new \Psiii\Mailer\PostOffice($mailSpoolSender, $transporterGmail);

/**
 * create Mail object
 */
$mail = $postOffice->createMail();

var_dump($psiiiMailer);

/**
 * gmail smtp
 */
#$mail->SMTPDebug = 3;                                              // Enable verbose debug output
$mail->setFrom($psiiiMailer['form-address'], 'Mailer');
$mail->addAddress($psiiiMailer['to-address'], 'Joe User');          // Add a recipient
$mail->addReplyTo($psiiiMailer['reply-address'], 'Information');

$mail->addAttachment(dirname(__FILE__) . '/image.jpg', 'new.jpg');  // Optional name
$mail->isHTML(true);                                                // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$postOffice->send();