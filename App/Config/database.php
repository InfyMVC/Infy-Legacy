<?php

$databaseoptions                        = array();

/**
 * This database is mainly used for executing queries
 */
$databaseoptions['master']              = array();
/*
* Can be mysqli
*/
$databaseoptions['master']['driver']    = 'mysqli';
/**
 * Hostname or IP from the database
 * Only used for non file based databases
 */
$databaseoptions['master']['hostname']  = 'localhost';
/**
 * Specify a custom port
 * when your databse isn't running on the standard port
 */
$databaseoptions['master']['port']      = 3306;
/**
 * User for logging in on the database
 */
$databaseoptions['master']['user']      = 'root';
/**
 * Password for logging in on the database
 */
$databaseoptions['master']['password']  = 'root';
/**
 * Database to use
 */
$databaseoptions['master']['database']  = '';
/**
 * If you need a custom charset u can define it here
 */
$databaseoptions['master']['charset']   = 'utf8';
/**
 * When you need to run some initial queries when u connect
 * you can specify them here
 */
$databaseoptions['master']['autoquery'] = 'set names utf8';
/**
 * Only used for file based databases
 */
$databaseoptions['master']['file']      = '';
/**
 * Use it only, when you don't want to write to the database
 */
$databaseoptions['master']['readonly']  = false;


$databaseoptions['slave'][0]              = array();
$databaseoptions['slave'][0]['driver']    = 'mysqli';
$databaseoptions['slave'][0]['hostname']  = 'localhost';
$databaseoptions['slave'][0]['port']      = 3306;
$databaseoptions['slave'][0]['user']      = 'root';
$databaseoptions['slave'][0]['password']  = '';
$databaseoptions['slave'][0]['database']  = 'db';
$databaseoptions['slave'][0]['charset']   = 'utf8';
$databaseoptions['slave'][0]['autoquery'] = 'set names utf8';
$databaseoptions['slave'][0]['file']      = '';
$databaseoptions['slave'][0]['readonly']  = 'true';