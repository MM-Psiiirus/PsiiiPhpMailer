<?php
/**
 * Created by PhpStorm.
 * User: tonigurski
 * Date: 23.05.16
 * Time: 16:56
 */

namespace Psiii\Mailer;


interface MailSpoolInterface
{

    public function send();
    public function add(Mail $mail);

}