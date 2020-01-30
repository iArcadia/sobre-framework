<?php

require_once(__DIR__ . '/../../../../autoload.php');

$force = isset($argv[1]) && ($argv[1] === '-f' || $argv[1] === '--force');

$directories = [
    'app',
    'app/models',
    'app/routes',
    'app/routes/home',
    'app/views',
    'config',
    'public',
    'public/css',
    'public/img',
    'public/js'
];

foreach ($directories as $directory) {
    $directory = root_path($directory);

    if (!file_exists($directory)) {
        echo 'Making "' . $directory . '" directory' . PHP_EOL;
        mkdir($directory);
    }
}

$files = [
    'app/models/Model.php',
    'app/routes/Controller.php',
    'app/routes/routes.php',
    'app/routes/home/HomeController.php',
    'app/views/base.blade.php',
    'app/views/breadcrumb.blade.php',
    'config/app.php',
    '.env',
    '.htaccess',
    'index.php'
];

foreach ($files as $file) {
    if (!file_exists(root_path($file))) {
        echo 'Copying "' . $file . '" file' . PHP_EOL;
        copy(sobre_path('core/' . $file), root_path($file));
    } else {
        if ($force) {
            echo 'Replacing "' . $file . '" file' . PHP_EOL;
            unlink(root_path($file));
            copy(sobre_path('core/' . $file), root_path($file));
        }
    }
}

echo 'The Sobre Framework v' . sobre_version() . ' project has been correctly initialized.';
exit();