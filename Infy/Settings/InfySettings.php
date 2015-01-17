<?php
namespace Infy\Settings;

use Infy\Infy;

class InfySettings
{
    /**
     * @var string
     */
    private $defaultCharset;

    /**
     * @var string
     */
    private $sessionHandler;

    /**
     * @param array $settings
     */
    public function init($settings)
    {
        $this->defaultCharset = $settings['database']['defaultCharset'];
        $this->sessionHandler = $settings['session']['sessionHandler'];
        Infy::set404RedirectRoute($settings['404redirectRoute']);
    }


    /**
     * @return string
     */
    public function getDefaultCharset()
    {
        return $this->defaultCharset;
    }

    /**
     * @return string
     */
    public function getSessionHandler()
    {
        return $this->sessionHandler;
    }


}
