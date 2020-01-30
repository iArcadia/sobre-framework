<?php

return [
    'namespace' => 'App\\Routes',
    'routes' => [
        /**
         * @uri /
         * @method GET
         * @action App\Routes\Home\HomeController::index
         */
        [
            'uri' => '/',
            'method' => 'get',
            'namespace' => 'Home',
            'controller' => 'HomeController',
            'action' => 'index',
            'routes' => []
        ]
    ]
];