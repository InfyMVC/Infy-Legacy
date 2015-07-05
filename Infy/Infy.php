<?php
namespace Infy;

use Infy\Database\InfyModel;
use Infy\Helper\PHPMailer;
use Infy\Log\InfyLog;
use Infy\Security\InfySecurity;
use Infy\Session\InfySession;
use Infy\Settings\InfySettings;
use Infy\Uri\InfyRouter;
use Infy\View;

/**
 * Class Infy
 * @package Infy
 */
class Infy
{
    /**
     * Holds all the routes
     * @var array
     */
    private static $_routes = array();

    /**
     * Holds an instance of the logger
     * @var Log\InfyLog
     */
    private static $_log;

    /**
     * Holds an instance of InfyRouter
     * @var Uri\InfyRouter
     */
    private static $_router;

    /**
     * Holds an instance of InfyView
     * @var View\InfyView
     */
    private static $_view;

    /**
     * Holds an instance of InfySettings
     * @var Settings\InfySettings
     */
    private static $_settings;

    /**
     * Holds an instance of InfyModel
     * @var Database\InfyModel
     */
    private static $_model;

    /**
     * Holds an instance of InfySession
     * @var Session\InfySession
     */
    private static $_sessionHandler;

    /**
     * Holds the namespace of the sessionhandler
     * @var string
     */
    private static $_sessionHandlerClass;

    /**
     * Holds an instance of InfySecurity
     * @var InfySecurity
     */
    private static $_security;

    /**
     * Holds an instance of PHPMailer
     * @var PHPMailer
     */
    private static $_mailer;

    /**
     * Holds an string for the route when a 404 happens
     * @var string
     */
    private static $_404RedirectRoute;

    /**
     * Current version
     * @var string
     */
    private static $_version = "0.0.2";

    /**
     * Sets the routes for the router
     *
     * @param array $routes
     */
    public static function setRoutes($routes)
    {
        if ($routes == null || count($routes) == 0)
        {
            return;
        }

        Infy::Router()->addRoutes($routes);

        self::$_routes = $routes;
    }

    /**
     * Return the routes
     * @return array
     */
    public static function getRoutes()
    {
        return self::$_routes;
    }

    /**
     * Gets the logger
     * @return \Infy\Log\InfyLog
     */
    public static function Log()
    {
        if (self::$_log == null)
            self::$_log = new InfyLog();

        return self::$_log;
    }

    /**
     * Gets the view
     * @return View\InfyView
     */
    public static function View()
    {
        if (self::$_view == null)
            self::$_view = new View\InfyView();

        return self::$_view;
    }

    /**
     * Gets the router
     * @return \Infy\Uri\InfyRouter
     */
    public static function Router()
    {
        if (self::$_router == null)
            self::$_router = new InfyRouter();

        return self::$_router;
    }

    /**
     * Gets the settings
     * @return InfySettings
     */
    public static function Settings()
    {
        if (self::$_settings == null)
            self::$_settings = new InfySettings();

        return self::$_settings;
    }

    /**
     * Gets the model
     * @return InfyModel
     */
    public static function Model()
    {
        if (self::$_model == null)
            self::$_model = new InfyModel();

        return self::$_model;
    }

    /**
     * Gets the sessionhandler
     * @throws \Exception
     */
    public static function Session()
    {
        if (self::$_sessionHandler == null)
        {
            self::$_sessionHandler = new self::$_sessionHandlerClass;

            if (!(self::$_sessionHandler instanceof InfySession))
            {
                Infy::Log()->error("The specified sessionhandler isn't an instance of InfySession");
                throw new \Exception("The specified sessionhandler isn't an instance of InfySession");
            }
        }

        return self::$_sessionHandler;
    }

    /**
     * Gets the security
     * @return InfySecurity
     */
    public static function Security()
    {
        if (self::$_security == null)
            self::$_security = new InfySecurity();

        return self::$_security;
    }

    /**
     * Gets the phpmailer
     * @return PHPMailer
     */
    public static function Mail()
    {
        if (self::$_mailer == null)
            self::$_mailer = new PHPMailer();

        return self::$_mailer;
    }

    /**
     * @return string
     */
    public static function get404RedirectRoute()
    {
        return self::$_404RedirectRoute;
    }

    /**
     * @param string $route
     */
    public static function set404RedirectRoute($route)
    {
        self::$_404RedirectRoute = $route;
    }


    /**
     * @param string $classname
     */
    public static function __autoload($classname)
    {
        // check for composer
        if (file_exists("../vendor/composer/autoload_namespaces.php"))
        {
            // composer is installed and has installed some packages
            $composerNamespaces = require "../vendor/composer/autoload_namespaces.php";

            if (!array_key_exists($classname, $composerNamespaces))
            {
                // Class is Infy or app related
                $filepath = ".." . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $classname) . ".php";
            }
            else
            {
                // Class is managed via composer
                $tempPath = $composerNamespaces[$classname][0];
                $filepath = str_replace("\\", DIRECTORY_SEPARATOR, str_replace("/", DIRECTORY_SEPARATOR, $tempPath) . DIRECTORY_SEPARATOR . $classname) . ".php";
            }
        }
        else
        {
            $filepath = ".." . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $classname) . ".php";
        }

        if (file_exists($filepath))
        {
            require_once $filepath;
        }
        else
        {
            Infy::Log()->error("Can't find file to class '" . $classname . "''");
        }
    }

    /**
     * Run the mysterious code!
     */
    public static function run()
    {
        Infy::Router()->setBasePath(str_replace($_SERVER["QUERY_STRING"], "", $_SERVER["REQUEST_URI"]));

        self::$_sessionHandlerClass = self::Settings()->getSessionHandler();

        self::Session()->startSession();

        $result = Infy::Router()->match();

        if ($result == false)
        {
            header("Location: " . Infy::Router()->generate(self::$_404RedirectRoute));

            return;
        }
        else
        {
            if (!is_array($result["target"]))
            {
                Infy::Log()->error("The route with the name '" . $result["name"] . "' must have an array with the indexes 'controller' and 'action' before we can call all things");
            }
            else
            {
                try
                {
                    $controllerName = (Infy::Settings()->getAppendDefaultNamespaceToControllers() ? "App\\Controller\\" . $result["target"]["controller"] : $result["target"]["controller"] );
                    $methodName = $result["target"]["action"];

                    $reflectedController = new \ReflectionClass($controllerName);

                    if (!$reflectedController->hasMethod($methodName))
                    {
                        Infy::Log()->error("Class '" . $controllerName . "' doesn't have the method '" . $methodName . "''");
                        return;
                    }

                    $reflectedMethod = $reflectedController->getMethod($methodName);

                    if ($reflectedMethod->isPrivate() || $reflectedMethod->isProtected())
                    {
                        Infy::Log()->error("Method '" . $methodName . "' in class '" . $controllerName . "' is private or protected. Please change the visibility to public.");
                        return;
                    }

                    if ($reflectedMethod->isStatic())
                    {
                        $controllerName::{$methodName}();
                    }
                    else
                    {
                        $controller = new $controllerName();
                        $controller->{$methodName}();
                    }
                }
                catch (\ReflectionException $exception)
                {
                    Infy::Log()->error("Infy had some problems while reflecting a class. Please report back to the developer team.");
                }
            }
        }
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return self::$_version;
    }
}
