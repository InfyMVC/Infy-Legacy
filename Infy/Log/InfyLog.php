<?php
namespace Infy\Log;

/**
 * Class InfyLog
 * @package Infy\Log
 */
class InfyLog
{
    /**
     * @var string
     */
    private $path = "../logs/";

    /**
     * @var resource
     */
    private $infoLog;

    /**
     * @var resource
     */
    private $warnLog;

    /**
     * @var resource
     */
    private $errorLog;

    /**
     * @var resource
     */
    private $debugLog;

    /**
     * @var resource
     */
    private $sqlLog;

    public function __construct()
    {
        if (!file_exists($this->path."info.log") && is_writable($this->path."info.log"))
            touch($this->path."info.log");

        if (!file_exists($this->path."warn.log") && is_writable($this->path."warn.log"))
            touch($this->path."warn.log");

        if (!file_exists($this->path."error.log") && is_writable($this->path."error.log"))
            touch($this->path."error.log");

        if (!file_exists($this->path."debug.log") && is_writable($this->path."debug.log"))
            touch($this->path."debug.log");

        if (!file_exists($this->path."sql.log") && is_writable($this->path."sql.log"))
            touch($this->path."sql.log");

        $this->infoLog  = fopen($this->path."info.log" , "a+");
        $this->warnLog  = fopen($this->path."warn.log" , "a+");
        $this->errorLog = fopen($this->path."error.log", "a+");
        $this->debugLog = fopen($this->path."debug.log", "a+");
        $this->sqlLog   = fopen($this->path."sql.log", "a+");
    }

    /**
     * Logs a message to info.log
     * @param string $message
     */
    public function info($message)
    {
        if (is_resource($this->infoLog))
            fwrite($this->infoLog, date("d.m.Y H:i:s") . " " . str_replace(str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . str_replace("/", "\\", str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"])), "", debug_backtrace()[0]["file"]) . ":". debug_backtrace()[0]["line"] . "> " . $message . PHP_EOL);
    }

    /**
     * Logs a message to warn.log
     * @param string $message
     */
    public function warn($message)
    {
        if (is_resource($this->warnLog))
            fwrite($this->warnLog, date("d.m.Y H:i:s") . " " . str_replace(str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . str_replace("/", "\\", str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"])), "", debug_backtrace()[0]["file"]) . ":". debug_backtrace()[0]["line"] . "> " . $message . PHP_EOL);
    }

    /**
     * Logs a message to error.log
     * @param string $message
     */
    public function error($message)
    {
        if (is_resource($this->errorLog))
            fwrite($this->errorLog, date("d.m.Y H:i:s") . " " . str_replace(str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . str_replace("/", "\\", str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"])), "", debug_backtrace()[0]["file"]) . ":". debug_backtrace()[0]["line"] . "> " . $message . PHP_EOL);
    }

    /**
     * Logs a message to debug.log
     * @param string $message
     */
    public function debug($message)
    {
        if (is_resource($this->debugLog))
            fwrite($this->debugLog, date("d.m.Y H:i:s") . " " . str_replace(str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . str_replace("/", "\\", str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"])), "", debug_backtrace()[0]["file"]) . ":". debug_backtrace()[0]["line"] . "> " . $message . PHP_EOL);
    }

    /**
     * Logs a message to sql.log
     * @param string $message
     */
    public function sql($message)
    {
        if (is_resource($this->sqlLog))
            fwrite($this->sqlLog, date("d.m.Y H:i:s") . " " . str_replace(str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . str_replace("/", "\\", str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"])), "", debug_backtrace()[0]["file"]) . ":". debug_backtrace()[0]["line"] . "> " . $message . PHP_EOL);
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        if (is_resource($this->infoLog))
            fclose($this->infoLog);

        if (is_resource($this->warnLog))
            fclose($this->warnLog);

        if (is_resource($this->errorLog))
            fclose($this->errorLog);

        if (is_resource($this->debugLog))
            fclose($this->debugLog);
    }
}
