<?php

return [
    'app' => [
        'url' => $app->getEnv('APP_URL', 'http://localhost'),
        'name' => 'My App',
        'timezone' => 'America/New_York',
    ],
    'database' => [
        'name' => 'myapp',
        'username' => 'root',
        'password' => '',
    ]
];
