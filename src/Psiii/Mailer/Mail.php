<?php
/**
 * Created by PhpStorm.
 * User: tonigurski
 * Date: 23.05.16
 * Time: 11:05
 */

namespace Psiii\Mailer;

/**
 * Class PHPMailer
 *
 * @package Psiii\Mailer
 */
class Mail extends \PHPMailer
{

    protected $transporter;

    /**
     * Mail constructor.
     * @param TransporterBasic|null $mailTransporter
     * @param boolean $exceptions Should we throw external exceptions?
     */
    public function __construct(TransporterBasic $mailTransporter = null, $exceptions = null)
    {
        parent::__construct($exceptions);

        if ($mailTransporter) {

            if ($mailTransporter->isSMTP())
                $this->isSMTP();                                         // Set mailer to use SMTP

            $this->Host = $mailTransporter->getHost() | '';              // Specify main and backup SMTP servers
            $this->SMTPAuth = $mailTransporter->isSMTPAuth() | false;    // Enable SMTP authentication
            $this->Username = $mailTransporter->getUsername() | '';      // SMTP username
            $this->Password = $mailTransporter->getPassword() | '';      // SMTP password
            $this->SMTPSecure = $mailTransporter->getSMTPSecure() | '';  // Enable TLS encryption, `ssl` also accepted
            $this->Port = $mailTransporter->getPort() | '';              // TCP port to connect to
        }

    }


    public function send()
    {
        return parent::send();
    }

}