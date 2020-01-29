<?php

$dir_to_copy = ['public', 'database', 'config'];
$root_files_to_copy = ['index.php', '.env', '.htaccess'];

echo root_path() . PHP_EOL;
echo sobre_path() . PHP_EOL;

echo PHP_EOL;
echo 'The Sobre Framework project has been correctly initialized.';
echo PHP_EOL;
exit();