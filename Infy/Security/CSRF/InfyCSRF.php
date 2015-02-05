<?php
namespace Infy\Security\CSRF;

use Exception;
use Infy\Controller\InfyController;

/**
 * Class InfyCSRF
 * @package Infy\Security\CSRF
 * @author  FrickX
 */
class InfyCSRF
{
    /**
     * @var int
     */
    private $timeout = 300;

    /**
     * Should we check GET-Requests?
     * @var bool
     */
    private $checkGETRequests = false;

    /**
     * If you want other values then you can specify them here
     *
     * @param int  $timeout
     * @param bool $checkGETRequests
     *
     * @throws Exception
     */
    function __construct($timeout = 300, $checkGETRequests = false)
    {
        if (!session_id())
            throw new Exception('Cant find sessionid', 1);

        $this->timeout = $timeout;
        $this->checkGETRequests = $checkGETRequests;
    }

    /**
     * Generates a random string
     *
     * @param int $length
     *
     * @return string
     */
    protected function generateRandomString($length = 32)
    {
        $randomString = "";
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charactersLength = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++)
            $randomString .= $characters[rand(0, $charactersLength)];

        return $randomString;
    }

    /**
     * Calculates the hash for current csrf
     * @return string
     */
    protected function calculateHash()
    {
        return sha1(implode($_SESSION["csrf"]));
    }

    /**
     * Generates the csrf token
     * @return string
     */
    public function generateToken()
    {
        $_SESSION['csrf'] = array();
        $_SESSION['csrf']['time'] = time();
        $_SESSION['csrf']['salt'] = $this->generateRandomString();
        $_SESSION['csrf']['sessid'] = session_id();
        $_SESSION['csrf']['ip'] = InfyController::getClientIP();

        $hash = $this->calculateHash();

        return base64_encode($hash);
    }

    /**
     * Generates a hidden field for the form
     * @return string
     */
    public function generateHiddenField()
    {
        $token = $this->generateToken();

        return '<input type="hidden" name="csrf" value="' . $token . '" />';
    }

    /**
     * Checks if the request is out of time
     *
     * @param null $timeout
     *
     * @return bool
     */
    protected function checkTimeout($timeout = null)
    {
        if (!$timeout)
            $timeout = $this->timeout;

        return ($_SERVER['REQUEST_TIME'] - $_SESSION['csrf']['time']) < $timeout;
    }

    /**
     * Checks the received csrf token
     *
     * @param null $timeout
     *
     * @return bool
     */
    public function checkToken($timeout = null)
    {
        if (!isset($_SESSION['csrf']) || !$this->checkTimeout($timeout) || !session_id())
            return false;

        $isGETRequest = isset($_GET['csrf']);
        $isPOSTRequest = isset($_POST['csrf']);

        if (($this->checkGETRequests && $isGETRequest) || $isPOSTRequest)
        {
            $tokenHash = base64_decode($_REQUEST['csrf']);

            $generatedHash = $this->calculateHash();

            if ($tokenHash && $generatedHash)
                return $tokenHash == $generatedHash;
        }

        return false;
    }
}