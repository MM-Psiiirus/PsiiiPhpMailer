<?php
/**
 * Created by PhpStorm.
 * User: tonigurski
 * Date: 25.05.16
 * Time: 09:45
 */

namespace Psiii\Mailer;


class TransporterBasic
{

    protected $SMTP = false;        // Set mailer to use SMTP
    protected $host = '';           // Specify main and backup SMTP servers
    protected $SMTPAuth = false;    // Enable SMTP authentication
    protected $username;            // SMTP username
    protected $password;            // SMTP password
    protected $SMTPSecure;          // Enable TLS encryption, `ssl` also accepted
    protected $port;                // TCP port to connect to

    /**
     * @return boolean
     */
    public function isSMTP()
    {
        return $this->SMTP;
    }

    /**
     * @param boolean $SMTP
     * @return TransporterBasic
     */
    public function setSMTP($SMTP)
    {
        $this->SMTP = $SMTP;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return TransporterBasic
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return TransporterBasic
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSMTPAuth()
    {
        return $this->SMTPAuth;
    }

    /**
     * @param boolean $SMTPAuth
     * @return TransporterBasic
     */
    public function setSMTPAuth($SMTPAuth)
    {
        $this->SMTPAuth = $SMTPAuth;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return TransporterBasic
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return TransporterBasic
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getSMTPSecure()
    {
        return $this->SMTPSecure;
    }

    /**
     * @param string $SMTPSecure
     * @return TransporterBasic
     */
    public function setSMTPSecure($SMTPSecure)
    {
        $this->SMTPSecure = $SMTPSecure;
        return $this;
    }


}