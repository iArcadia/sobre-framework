<?php

require_once('vendor/autoload.php');

use SobreFramework\Core\{Core, Session};

try {
    Core::start();

    require_once('public/views/base.blade.php');
} catch (\Exception $e) {
    dd($e);
}

Session::resetTemporaryData();