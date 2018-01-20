<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // base de datos
        'db' => [
            'driver' => 'pgsql',
            'host' => '158.69.198.138',
            'database' => 'hubsolar',
            'username' => 'hubsolar',
            'password' => '123456',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'port' => '5432'
        ],
        // swagger php
        'swagger' => [
          'path' => __DIR__ . '/../app/',
        ]
        
    ],
];
