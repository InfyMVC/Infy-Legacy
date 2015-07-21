<?php

namespace Infy\View;

use Infy\Infy;

/**
 * Class InfyView
 * @package Infy\View
 */
class InfyView
{

    /**
     * @var array
     */
    private $_registeredAssets = array();

    /**
     * @var array
     */
    private $_registeredTypes = array();

    /**
     * @param string $type
     * @param string $output
     */
    public function registerType($type, $output)
    {
        if ($type === (string) "")
        {
            Infy::Log()->error("No type was given to register");
            return;
        }

        if ($output === (string) "")
        {
            Infy::Log()->warn("There is no output for type: " . $type);
        }

        $this->_registeredTypes[$type] = $output;
    }

    /**
     * @param string $type
     * @param string $file
     * @return mixed
     */
    public function getOutputforType($type, $file)
    {
        if ($type === (string) "")
        {
            return;
        }

        if ($file === (string) "")
        {
            return;
        }

        return str_replace("%file%", $file, $this->_registeredTypes[$type]);
    }

    /**
     * Returns an array with the given files
     * @param  string $media Type of the media
     * @return void
     */
    public function getMedia($media)
    {
        if (!array_key_exists($media, $this->_registeredAssets))
        {
            return;
        }

        foreach ($this->_registeredAssets[$media] as $file)
        {
            switch ($media)
            {
                case 'css':
                    if ($file['isURL'])
                    {
                        echo '<link rel="stylesheet" href="' . $file['file'] . '">';
                    }
                    else
                    {
                        echo '<link rel="stylesheet" href="' . Infy::Router()->getBasePath() . $file['file'] . '">';
                    }
                    break;
                case 'js':
                    if ($file['isURL'])
                    {
                        echo '<script type="text/javascript" src="' . $file['file'] . '"></script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript" src="' . Infy::Router()->getBasePath() . $file['file'] . '"></script>';
                    }
                    break;
            }
        }
    }

    /**
     * Renders the give design file
     * @param  string $view Name of the file
     * @param  array $data Array with contents that can be used in the design
     * @return void
     */
    public function render($view, $data = array())
    {
        extract($data, EXTR_OVERWRITE);

        if (file_exists("../App/Views/" . $view . ".php"))
        {
            require_once("../App/Views/" . $view . ".php");
        }
        else
        {
            Infy::Log()->error("View " . $view . " not found. Redirecting to home route");
            Infy::Router()->redirect("");
        }
    }

    /**
     * @param string $type Type of the asset
     * @param string $filename Filename of the asset
     * @param bool $isURL Is the asset based on a URL?
     * @return void
     */
    public function registerAsset($type, $filename, $isURL = false)
    {
        if (!isset($this->_registeredAssets[$type]))
        {
            $this->_registeredAssets[$type] = arra();
        }

        $this->_registeredAssets[$type][] = array('file' => $filename, 'isURL' => $isURL);
    }
}
