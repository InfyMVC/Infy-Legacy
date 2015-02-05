<?php
namespace Infy\Session;

class InfySessionHandler implements InfySession
{

    /**
     * Starts a session
     */
    public function startSession()
    {
        session_start();
    }

    /**
     * Stops a session
     */
    public function stopSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}