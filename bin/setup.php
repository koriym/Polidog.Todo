<?php

require dirname(__DIR__) . '/autoload.php';
require_once dirname(__DIR__) . '/env.php';

chdir(dirname(__DIR__));
passthru('rm -rf var/tmp/*');
passthru('chmod 775 var/tmp');
passthru('chmod 775 var/log');

copy(dirname(__DIR__) . '/.env.dist', dirname(__DIR__) . '/.env');

$dsn = 'mysql:host=' . getenv('DB_HOST');
$pdo = new \PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));
$pdo->exec('CREATE DATABASE IF NOT EXISTS ' . getenv('DB_NAME') . ' CHARACTER SET ' . getenv('DB_CHARSET'));
$pdo->exec('CREATE DATABASE IF NOT EXISTS ' . getenv('DB_NAME') . '_test CHARACTER SET ' . getenv('DB_CHARSET'));
passthru('./vendor/bin/phinx migrate -c var/db/phinx/phinx.php -e development');
passthru('./vendor/bin/phinx migrate -c var/db/phinx/phinx.php -e test');
