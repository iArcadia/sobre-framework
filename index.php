<?php

require_once('vendor/autoload.php');

use SobreFramework\Core\{Core, Session};

Core::start();

try {
    require_once('public/views/base.blade.php');
} catch (\Exception $e) {
    dd($e);
}

Session::resetTemporaryData();