<?php

require_once(__DIR__ . '/../../../../autoload.php');

exec('composer require sobre-framework/core ' . $argv[1], $output);

foreach ($output as $line) {
    echo $line;
    echo PHP_EOL;
}

echo 'The Sobre Framework core has been correctly updated to ' . $argv[1] . '.';
exit();