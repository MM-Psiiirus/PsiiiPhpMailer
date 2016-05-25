<?php
/**
 * Created by PhpStorm.
 * User: tonigurski
 * Date: 25.05.16
 * Time: 09:53
 */

namespace Psiii\Mailer;


class TransporterGmail extends TransporterBasic
{
    protected $SMTP = true;                   // Set mailer to use SMTP
    protected $host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
    protected $SMTPAuth = true;               // Enable SMTP authentication
    protected $username = '';                 // SMTP username
    protected $password = '';                 // SMTP password
    protected $SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
    protected $port = 587;                    // TCP port to connect to

    /**
     * TransporterGmail constructor.
     *
     * @param $username Gmail Address
     * @param $password Gmail app-secret / password
     */
    function __construct($username,$password)
    {
        $this->username = $username;
        $this->password= $password;
    }


}