<?php

namespace Infy\Database;

use Infy\Database\Connectors\InfyMySQL;
use Infy\Infy;

/**
 * Class InfyModel
 * @package Infy\Database
 */
class InfyModel
{

    /**
     * Holds the actual number of the used slave
     * @var integer
     */
    private $_SlaveNo = 0;

    /**
     * Checks if the database connection is initialized
     * @var boolean
     */
    private $_IsInitialized = false;

    /**
     * Checks if the master connection doesnt working and Infy must use a slave
     * @var boolean
     */
    private $_UseSlave = false;

    /**
     * @var InfyMySQL
     */
    private $_Connection = null;

    /**
     * @param array $options
     */
    public function init($options = array())
    {
        if (!Infy::Settings()->getUseDatabase())
        {
            return;
        }

        switch ($options['master']['driver'])
        {
            case 'mysqli':
                $this->_Connection = new InfyMySQL($options['master']['hostname'], $options['master']['port'], $options['master']['user'], $options['master']['password'], $options['master']['database'], $options['master']['autoquery'], $options['master']['readonly'], $options['master']['charset']);
                if ($this->_Connection->connect() == false)
                {
                    $this->_UseSlave = true;
                    $this->initSlave($options);
                }
                else
                {
                    $this->_IsInitialized = true;
                }
                break;
            case 'sqlite':
                break;
        }
    }

    /**
     * @param array $options
     */
    public function initSlave($options)
    {
        if (!$this->_UseSlave)
        {
            return;
        }

        if (!array_key_exists($this->_SlaveNo, $options['slave']))
        {
            Infy::Log()->error("Infy can't connect to the database");
            return;
        }

        switch ($options['master']['driver'])
        {
            case 'mysqli':
                $this->_Connection = new InfyMySQL($options['slave'][$this->_SlaveNo]['hostname'], $options['slave'][$this->_SlaveNo]['port'], $options['slave'][$this->_SlaveNo]['user'], $options['slave'][$this->_SlaveNo]['password'], $options['slave'][$this->_SlaveNo]['database'], $options['slave'][$this->_SlaveNo]['autoquery'], $options['slave'][$this->_SlaveNo]['readonly'], $options['slave'][$this->_SlaveNo]['charset']);
                if ($this->_Connection->connect() == false)
                {
                    $this->_SlaveNo += 1;
                    $this->initSlave($options);
                }
                else
                {
                    $this->_IsInitialized = true;
                }
                break;
            case 'sqlite':
                break;
        }
    }

    /**
     * @return boolean
     */
    public function isInitialized()
    {
        return $this->_IsInitialized;
    }

    /**
     * @return int
     */
    public function getSlaveNo()
    {
        return $this->_SlaveNo;
    }

    /**
     * @return boolean
     */
    public function getUseSlave()
    {
        return $this->_UseSlave;
    }

    /**
     * @return InfyMySQL
     */
    public function getConnection()
    {
        return $this->_Connection;
    }
}
