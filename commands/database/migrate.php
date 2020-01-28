<?php

require_once('vendor/autoload.php');

\src\Core::command();

if (!isset($argv[1])) {
    \database\Migrator::migrate();
    exit();
}

$arg = $argv[1];

switch ($arg) {
    case '--migrate':
    case '-m':
        \database\Migrator::migrate();
        break;

    case '--drop':
    case '-d':
        \database\Migrator::drop();
        break;

    case '--seed':
    case '-s':
        \database\Migrator::seed();
        break;

    case '--refresh':
    case '-r':
        \database\Migrator::drop();
        \database\Migrator::migrate();
        \database\Migrator::seed();
        break;

    default:
        echo 'Argument ' . $arg . ' does not exist.';
}

echo PHP_EOL;
exit();