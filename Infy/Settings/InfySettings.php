<?php

namespace Infy\Settings;

use Infy\Infy;

class InfySettings
{

    /**
     *
     * @var boolean Set if Infy should connect to the database
     */
    private $useDatabase;

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
     *
     * @var boolean Should Infy append by default the default namespace 'App\Controller'
     */
    private $appendDefaultNamespaceToControllers;

    /**
     * @param array $settings
     */
    public function init($settings)
    {
        if (isset($settings['database']['useDatabase']))
        {
            $this->useDatabase = $settings['database']['useDatabase'];
        }

        if (isset($settings['database']['defaultCharset']))
        {
            $this->defaultCharset = $settings['database']['defaultCharset'];
        }

        if (isset($settings['session']['sessionHandler']))
        {
            $this->sessionHandler = $settings['session']['sessionHandler'];
        }

        if (isset($settings['log']['directory']))
        {
            $this->logDirectory = $settings['log']['directory'];
        }

        if (isset($settings['route']['appendDefaultNamespaceToControllers']))
        {
            $this->appendDefaultNamespaceToControllers = $settings['route']['appendDefaultNamespaceToControllers'];
        }

        if (isset($settings['route']['mergeParamsWithPost']))
        {
            $this->shouldMergeWithPost = $settings['route']['mergeParamsWithPost'];
        }

        if (isset($settings['route']['404redirectRoute']))
        {
            Infy::set404RedirectRoute($settings['route']['404redirectRoute']);
        }
    }

    /**
     *
     * @return boolean Set if Infy should connect to the database
     */
    public function getUseDatabase()
    {
        return $this->useDatabase;
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
     * @return bool Should Infy append by default the default namespace to the controllers in routes.php
     */
    public function getAppendDefaultNamespaceToControllers()
    {
        return $this->appendDefaultNamespaceToControllers;
    }

    /**
     * @return bool Merge route parameters with $_REQUEST
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
