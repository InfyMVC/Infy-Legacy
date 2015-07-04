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
     * @var boolean Should Infy merge the route params with the post params
     */
    private $shouldMergeWithPost;

    /**
     * @param array $settings
     */
    public function init($settings)
    {
        if (isset($settings['database']['defaultCharset']))
            $this->defaultCharset = $settings['database']['defaultCharset'];

        if (isset($settings['session']['sessionHandler']))
            $this->sessionHandler = $settings['session']['sessionHandler'];

        if(isset($settings['log']['directory']))
            $this->logDirectory = $settings['log']['directory'];

        if(isset($settings['route']['mergeParamsWithPost']))
            $this->shouldMergeWithPost = $settings['route']['mergeParamsWithPost'];

        Infy::set404RedirectRoute($settings['route']['404redirectRoute']);
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
     * @return boolean Merge route parameters with $_REQUEST
     */
    public function shouldMergeWithPost()
    {
        return $this->shouldMergeWithPost;
    }

    /**
     * @return string Directory where to save the logs
     */
    public function getLogDirectory()
    {
        return $this->logDirectory;
    }
}
