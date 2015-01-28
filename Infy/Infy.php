<?php
namespace Infy;

use Infy\Database\InfyModel;
use Infy\Helper\PHPMailer;
use Infy\Log\InfyLog;
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
     * @var Uri\InfyRouter
     */
    private static $_router;

    /**
     * @var View\InfyView
     */
    private static $_view;

    /**
     * @var Settings\InfySettings
     */
    private static $_settings;

    /**
     * @var Database\InfyModel
     */
    private static $_model;

    /**
     * @var Session\InfySession
     */
    private static $_sessionHandler;

    /**
     * @var string
     */
    private static $_sessionHandlerClass;

    /**
     * @var PHPMailer
     */
    private static $_mailer;

    /**
     * @var string
     */
    private static $_404RedirectRoute;

    /**
     * Current Versionstring
     * @var string
     */
    private static $_version = "0.1 alpha";

    /**
     * Sets the routes for the router
     * @param array $routes
     */
    public static function setRoutes($routes)
    {
        if($routes == null || count($routes) == 0)
            return;

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
     * @return \App\Session\PMSSessionHandler
     * @throws \Exception
     */
    public static function Session()
    {
        if (self::$_sessionHandler == null)
        {
            self::$_sessionHandler = new self::$_sessionHandlerClass;
            if (!(self::$_sessionHandler instanceof InfySession))
            {
                Infy::Log()->error("Der SessionHandler ist keine Instanz von InfySession");
                throw new \Exception("Der SessionHandler ist keine Instanz von InfySession");
            }
        }

        return self::$_sessionHandler;
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
        $filepath = ".." . DIRECTORY_SEPARATOR .str_replace("\\", DIRECTORY_SEPARATOR, $classname) . ".php";

        if (file_exists($filepath))
            require_once $filepath;
        else
            Infy::Log()->error("Can't find file to class " . $classname);
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
                Infy::Log()->error("There is an eror with the routes...");
            else
            {
                $controllerName = "App\\Controller\\".$result["target"]["controller"];
                $controller = new $controllerName();
                $controller->{$result["target"]["action"]}();
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
