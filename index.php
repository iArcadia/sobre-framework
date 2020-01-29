<?php

require_once('vendor/autoload.php');

use SobreFramework\Core\{Core, Session};

try {
    Core::start();

    require_once(root_path('app/views/base.blade.php'));
} catch (\Exception $e) {
    dd($e);
}

Session::resetTemporaryData();