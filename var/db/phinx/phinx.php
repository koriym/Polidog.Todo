<?php
require dirname(__DIR__, 3) . '/autoload.php';

use josegonzalez\Dotenv\Loader;

$env = dirname(__DIR__, 3) . '/.env';
(new Loader($env))->parse()->putenv(true);
$dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=' . getenv('DB_CHARSET');
$development = new \PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));

(new Loader($env))->parse()->putenv(true);
$dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . '_test;charset=' . getenv('DB_CHARSET');
$test = new \PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));

return [
    'paths' => [
        'migrations' => __DIR__ . '/migrations',
        'seeds' => __DIR__ . '/seeds',
    ],
    'environments' => [
        'development' => [
            'name' => $development->query('SELECT DATABASE()')->fetchColumn(),
            'connection' => $development
        ],
        'test' => [
            'name' => $test->query('SELECT DATABASE()')->fetchColumn(),
            'connection' => $test
        ]
    ]
];
