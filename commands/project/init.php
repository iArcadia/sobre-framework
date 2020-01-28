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

recursive_copy(join(DIRECTORY_SEPARATOR, ['..', '..', 'public']), join(DIRECTORY_SEPARATOR, ['..', '..', '..', '..']));

echo PHP_EOL;
exit();