<?php
namespace Infy\Controller;

use Infy\Infy;
use Infy\View\InfyView;

/**
 * Class InfyController
 * @package Infy\Controller
 */
class InfyController
{
    /**
     * Parameters from the URL
     * @var array
     */
    protected $_params;

    /**
     * Holds an instance of InfyView
     * @var InfyView
     */
    protected $_view;

    /**
     * Holds the submitted extension from the url
     * @var string
     */
    protected $_extension;

    public function __construct()
    {
        $this->_params = Infy::Router()->getParams();
        $this->_extension = Infy::Router()->getExtension();
        $this->_view = Infy::View();
    }

    /**
     * @author FrickX
     * @return string
     */
    public function getClientLanguage()
    {
        $languages = array();
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            // break up string into pieces (languages and q factors)
            preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i',
                            $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
            if (count($lang_parse[1]))
            {
                $languages = array_combine($lang_parse[1], $lang_parse[4]);
                foreach ($languages as $lang => $val)
                    if ($val === '')
                        $languages[$lang] = 1;
                arsort($languages, SORT_NUMERIC);
            }
        }
        foreach ($languages as $lang => $val)
            break;
        if (stristr($lang,"-"))
        {
            $tmp = explode("-",$lang);
            $lang = $tmp[0];
        }
        return $lang;
    }

    /**
     * Returns the actual IP-address of the client
     * @return string IP-address of the client
     */
    public function clientIP()
    {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
            return getenv('HTTP_CLIENT_IP');
        elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
            return getenv('HTTP_X_FORWARDED_FOR');
        elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
            return getenv('REMOTE_ADDR');
        elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
            return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Checks if the request is based on AJAX
     * @return boolean Returns true if the request is based on AJAX
     */
    public function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }
}
