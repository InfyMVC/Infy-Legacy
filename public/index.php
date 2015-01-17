<?php

$routes = array();
$options = array();
$databaseoptions = array();

require "../App/Config/routes.php";
require "../App/Config/settings.php";
require "../App/Config/database.php";
require "../Infy/Infy.php";


spl_autoload_register('\Infy\Infy::__autoload');
\Infy\Infy::setRoutes($routes);
\Infy\Infy::Settings()->init($settings);
\Infy\Infy::Model()->init($databaseoptions);
\Infy\Infy::run();