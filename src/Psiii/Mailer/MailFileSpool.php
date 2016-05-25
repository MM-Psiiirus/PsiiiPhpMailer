<?php
/**
 * Created by PhpStorm.
 * User: tonigurski
 * Date: 23.05.16
 * Time: 11:36
 */

namespace Psiii\Mailer;


class MailFileSpool implements MailSpoolInterface
{

    private $dir;

    function __construct($spoolDir)
    {
        $this->dir = $spoolDir;

    }

    /**
     * @param string $dir
     * @return array
     */
    public function getUnsentMessageFiles($dir)
    {

        $files = ScanDir::scan($dir, "message");

        return $files;
    }

    /**
     * @param string $dir
     * @return array|Mail[]
     */
    public function getPHPMailerInstances($dir)
    {
        $files = $this->getUnsentMessageFiles($dir);

        /**
         * @var Mail[]
         */
        $phpMailers = array();

        foreach ($files as $file) {
            $serializedObject = file_get_contents($file);

            /**
             * @var Mail
             */
            $phpMailerInst = unserialize($serializedObject);

            if($phpMailerInst instanceof Mail)
                $phpMailers[$file] = $phpMailerInst;
        }

        return $phpMailers;
    }

    public function add(Mail $mail)
    {
        $MailerObject = serialize($mail);

        $fileName = microtime(true).str_pad(dechex(mt_rand(0, 0xFFFFF)), 5, '0', STR_PAD_LEFT) . ".message";

        file_put_contents($this->dir.'/'. $fileName, $MailerObject);
    }

    public function send()
    {
        $mailerInstances = $this->getPHPMailerInstances($this->dir);

        foreach ($mailerInstances as $file => $phpMailer) {
            /**
             * $phpMailer
             * @var Mail
             */

            if ($phpMailer->send()) {
                unlink($file);
            } else {

                $address = "";
                foreach ($phpMailer->getToAddresses() as $email)
                    $address .= $email[1] . " <" . $email[0] . "> |";

                $error = 'PsiiiMailer::spool-sender coudn\'t send mail to ' . $address . " - " . $file;

                if ($phpMailer->isError())
                    $error .= ": Error " . $phpMailer->ErrorInfo;

                trigger_error($error);
            }
        }

    }
}