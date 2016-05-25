# PsiiiPhpMailer
Extended PHPMailer to implement a Symfony-Swiftmailer like spooling mechanic.


~~~
...
/**
 * load PostOffice Class
 */
$spoolDir = dirname(__FILE__) . '/spool';
$mailSpoolSender = new \Psiii\Mailer\MailFileSpool($spoolDir);
$transporterGmail = new \Psiii\Mailer\TransporterGmail('ACME@gmail.com','acme-my-pass');

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
$mail->setFrom('ACME@my-acme.com', 'Mailer');
$mail->addAddress('ACME@my-acme-customer.com', 'Joe User');          // Add a recipient
$mail->addReplyTo('ACME-reply@my-acme.com', 'Information');

$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$postOffice->send();

~~~

~~~
/**
 * Cron to send file-spooled mails 
 */
 
 ... 
 
 $spoolDir = dirname(__FILE__).'/spool';
 
 $mailSpoolSender = new \Psiii\Mailer\MailFileSpool($spoolDir);
 $mailSpoolSender->send();
~~~