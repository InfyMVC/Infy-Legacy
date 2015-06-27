<?php
$settings = array();

/**
 * Set the default charset for the database
 */
$settings['database']['defaultCharset'] = 'UTF8';

/**
 * Default sessionhandler
 */
$settings['session']['sessionHandler'] = 'Infy\\Session\\InfySessionHandler';

/**
 * Set the route where to redirect to 404 routes
 */
$settings['404redirectRoute'] = '';

/**
 * Directory where to save the logs
 */
$settings['log']['directory'] = '../logs/';