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
            'action' => 'index'
        ],
        /**
         * @uri /test/
         * @method GET
         * @action App\Routes\Home\HomeController::test
         */
        [
            'uri' => 'test',
            'method' => 'get',
            'namespace' => 'Home',
            'controller' => 'HomeController',
            'action' => 'test',
            'routes' => [
                /**
                 * @uri /test/hello/
                 * @method GET
                 * @action App\Routes\Home\HomeController::hello
                 */
                [
                    'uri' => 'hello',
                    'method' => 'get',
                    'namespace' => 'Home',
                    'controller' => 'HomeController',
                    'action' => 'hello'
                ]
            ]
        ]
    ]
];