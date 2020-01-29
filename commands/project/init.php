<?php

require_once(__DIR__ . '/../../../../autoload.php');

$directories = [
    'app',
    'app/models',
    'app/routes',
    'app/views',
    'config',
    'public',
    'public/css',
    'public/img',
    'public/js'
];

foreach ($directories as $directory) {
    echo 'Making "' . $directory . '" directory' . PHP_EOL;
    $directory = root_path($directory);

    if (!file_exists($directory)) {
        mkdir($directory);
    }
}

$files = [
    'app/models/Model.php',
    'app/routes/Controller.php',
    'app/views/base.blade.php',
    'app/views/breadcrumb.blade.php',
    'config/app.php',
    'config/router.php',
    '.env',
    '.htaccess',
    'index.php'
];

foreach ($files as $file) {
    echo 'Copying "' . $file . '" file' . PHP_EOL;
    if (!file_exists(root_path($file))) {
        copy(sobre_path($file), root_path($file));
    }
}

echo 'The Sobre Framework project has been correctly initialized.';
exit();