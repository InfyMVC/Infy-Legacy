<?php

$settings = array();

/**
 * Set if Infy should connect to the database
 */
$settings['database']['useDatabase'] = false;

/**
 * Set the default charset for the database
 */
$settings['database']['defaultCharset'] = 'UTF8';

/**
 * Default sessionhandler
 */
$settings['session']['sessionHandler'] = 'Infy\\Session\\InfySessionHandler';

/**
 * Should Infy append by default the namespace to the Controllers
 */
$settings['route']['appendDefaultNamespaceToControllers'] = false;

/**
 * Should Infy merge the params of the route with the $_POST parameters
 */
$settings['route']['mergeParamsWithPost'] = true;

/**
 * Set the route where to redirect when the route was not found
 */
$settings['route']['404redirectRoute'] = '404';

/**
 * Directory where to save the logs
 */
$settings['log']['directory'] = '../logs/';
