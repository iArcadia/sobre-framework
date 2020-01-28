<?php

/**
 * @param string $source
 * @param string $destination
 */
function recursive_copy(string $source, string $destination): void
{
    $directory = opendir($source);

    @mkdir($destination);

    while (false !== ($file = readdir($directory))) {
        if ($file !== '.' && $file !== '..') {
            if (is_dir($source . DIRECTORY_SEPARATOR . $file)) {
                recursive_copy($source . DIRECTORY_SEPARATOR . $file, $destination . DIRECTORY_SEPARATOR . $file);
            } else {
                copy($source . DIRECTORY_SEPARATOR . $file, $destination . DIRECTORY_SEPARATOR . $file);
            }
        }
    }

    closedir($directory);
}

$dir_to_copy = ['public', 'database', 'config'];
$files_to_copy = ['index.php', '.env', '.htaccess'];

foreach ($dir_to_copy as $dir) {
    recursive_copy(join(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', $dir]), join(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', '..', '..', '..', $dir]));
}

foreach ($files_to_copy as $file) {
    copy(join(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', $file]), join(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', '..', '..', '..', $file]));
}

echo PHP_EOL;
echo 'The Sobre project has been correctly initialized.';
echo PHP_EOL;
exit();