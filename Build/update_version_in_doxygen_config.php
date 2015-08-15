<?php

$handle = fopen("Infy/Infy.php", "r");

$version = null;

if ($handle)
{
    while (($line = fgets($handle)) !== false)
    {
        preg_match('/private static \$_version = "(?<version>.*)";/', $line, $matches);

        if (count($matches) != 0)
        {
            $version = $matches["version"];
        }
    }

    fclose($handle);
}
else
{
    echo "Can't open '../Infy/Infy.php'. Please check your file permissions";
}

$doxygenConfig = file_get_contents("../doxygen.config");

$doxygenConfig = preg_replace('/PROJECT_NUMBER         =.*/', 'PROJECT_NUMBER         = '.$version, $doxygenConfig);

file_put_contents("doxygen.config", $doxygenConfig);