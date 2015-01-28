<?php
namespace Infy\Database\Connectors;

use Infy\Infy;

/**
 * Class InfyMySQL
 * @package Infy\Database\Connectors
 */
class InfyMySQL
{
    /**
     * @var string
     */
    private $hostname;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $database;

    /**
     * @var bool
     */
    private $readonly;

    /**
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $autoquery;

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @param string $hostname
     * @param int $port
     * @param string $username
     * @param string $password
     * @param string $database
     * @param string $autoquery
     * @param bool $readonly
     * @param string $charset
     */
    public function __construct($hostname, $port, $username, $password , $database, $autoquery = "", $readonly = false, $charset = "")
    {
        $this->hostname     = $hostname;
        $this->port         = $port;
        $this->username     = $username;
        $this->password     = $password;
        $this->database     = $database;
        $this->autoquery    = $autoquery;
        $this->readonly     = $readonly;
        $this->charset      = $charset;
    }

    /**
     * @return bool|\PDO
     */
    public function connect()
    {
        try
        {
            if ($this->charset == "")
                $this->connection = new \PDO('mysql:host=' . $this->hostname . ';port=' . $this->port . ';dbname=' . $this->database .
                    ';charset=' . Infy::Settings()->getDefaultCharset(), $this->username, $this->password);
            else
                $this->connection = new \PDO('mysql:host=' . $this->hostname . ';port=' . $this->port . ';dbname=' . $this->database .
                    ';charset=' . $this->charset, $this->username, $this->password);
        }
        catch (\PDOException $ex)
        {
            return false;
        }

        if (!($this->connection instanceof \PDO))
            return false;


        return $this->connection;
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
