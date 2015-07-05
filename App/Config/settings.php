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
 * Should Infy merge the params of the route with the $_POST parameters
 */
$settings['route']['mergeParamsWithPost'] = false;

/**
 * Set the route where to redirect when the route was not found
 */
$settings['route']['404redirectRoute'] = '';

/**
 * Directory where to save the logs
 */
$settings['log']['directory'] = '../logs/';