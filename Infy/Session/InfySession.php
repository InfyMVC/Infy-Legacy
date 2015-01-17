<?php
namespace Infy\Session;

interface InfySession
{
    /**
     * Starts a session
     */
    public function startSession();

    /**
     * Stops a session
     */
    public function stopSession();
}