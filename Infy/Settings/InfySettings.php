<?php
namespace Infy\Settings;

use Infy\Infy;

class InfySettings
{
    /**
     * @var string Default charset of the Database
     */
    private $defaultCharset;

    /**
     * @var string Path to class to the sessionHandler with namespace
     */
    private $sessionHandler;

    /**
     * @var string Directory where to save the logs
     */
    private $logDirectory;

    /**
     * @param array $settings
     */
    public function init($settings)
    {
        $this->defaultCharset = $settings['database']['defaultCharset'];
        $this->sessionHandler = $settings['session']['sessionHandler'];
        $this->logDirectory = $settings['log']['directory'];

        Infy::set404RedirectRoute($settings['404redirectRoute']);
    }


    /**
     * @return string Default charset of the database
     */
    public function getDefaultCharset()
    {
        return $this->defaultCharset;
    }

    /**
     * @return string Path to sessionHandler with namespace
     */
    public function getSessionHandler()
    {
        return $this->sessionHandler;
    }

    /**
     * @return string Directory where to save the logs
     */
    public function getLogDirectory()
    {
        return $this->logDirectory;
    }
}
