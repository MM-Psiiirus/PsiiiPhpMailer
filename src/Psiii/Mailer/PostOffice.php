<?php
/**
 * Created by PhpStorm.
 * User: tonigurski
 * Date: 23.05.16
 * Time: 13:43
 */

namespace Psiii\Mailer;


class PostOffice
{
    protected $mailSpool;
    protected $mails = array();
    protected $mailTransporter;

    /**
     * PostOffice constructor.
     * @param MailSpoolInterface|null $mailSpoolInterface
     * @param TransporterBasic|null $transporterBasic
     */
    function __construct(MailSpoolInterface $mailSpoolInterface = null, TransporterBasic $transporterBasic = null)
    {
        $this->mailSpool = $mailSpoolInterface;
        $this->mailTransporter = $transporterBasic;
    }

    /**
     * @param TransporterBasic|null $transporterBasic
     * @return Mail
     */
    function createMail(TransporterBasic $transporterBasic = null)
    {
        if ($transporterBasic == null && $this->mailTransporter)
            $transporterBasic = $this->mailTransporter;

        $mail = new Mail($transporterBasic);

        $this->mails[] = $mail;

        return $mail;
    }


    /**
     * @param bool $instant
     */
    function send($instant = false)
    {
        if ($instant === true || !$this->mailSpool) {

            // instant submission

            foreach ($this->mails as $mail)
                $mail->send();

            $this->mails = array();

        } else {

            // append to spool

            foreach ($this->mails as $mail) {

                $this->mailSpool->add($mail);
            }

            $this->mails = array();
        }
    }

    /**
     *
     */
    function __destruct()
    {
        $this->send();
    }
}