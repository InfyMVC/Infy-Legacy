<?php

namespace Infy\Security;

use Infy\Security\CSRF\InfyCSRF;

class InfySecurity
{

    /**
     * Holds an instance of InfyCSRF
     * @var InfyCSRF
     */
    private static $_infyCSRF;

    public static function getCSRF($timeout = 300, $checkGETRequests = false)
    {
        if (self::$_infyCSRF == null)
        {
            self::$_infyCSRF = new InfyCSRF($timeout, $checkGETRequests);
        }

        return self::$_infyCSRF;
    }
}
