<?php

error_reporting(E_ALL ^ E_NOTICE);

echo " Psiii/Mailer/Postoffice- CRON";

include '../vendor/autoload.php';

$spoolDir = dirname(__FILE__).'/spool';

$mailSpoolSender = new \Psiii\Mailer\MailFileSpool($spoolDir);
$mailSpoolSender->send();
