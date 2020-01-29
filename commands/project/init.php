<?php

require_once(__DIR__ . '/../../../../autoload.php');

$dir_to_copy = ['public', 'database', 'config'];
$root_files_to_copy = ['index.php', '.env', '.htaccess'];

foreach ($root_files_to_copy as $file) {
    copy(sobre_path('core/' . $file), root_path($file));
}

echo 'The Sobre Framework project has been correctly initialized.';
exit();