<?php

$options         = array();
$databaseoptions = array();

require "../App/Config/settings.php";
require "../App/Config/database.php";
require "../Infy/Infy.php";


spl_autoload_register('\Infy\Infy::__autoload');
\Infy\Infy::loadAllRoutes();
\Infy\Infy::Settings()->init($settings);
\Infy\Infy::Model()->init($databaseoptions);
\Infy\Infy::run();