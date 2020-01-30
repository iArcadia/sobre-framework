<?php

require_once('vendor/autoload.php');
dd(config('router.namespace.directory'));

use SobreFramework\Core\{Core, Session};

dd(\SobreFramework\Core\Router::findController());

try {
    Core::start();

    require_once(root_path('app/views/base.blade.php'));
} catch (\Exception $e) {
    dd($e);
}

Session::resetTemporaryData();