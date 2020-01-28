<?php

echo __DIR__;

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

//recursive_copy('../public', $argv[1]);

echo PHP_EOL;
exit();