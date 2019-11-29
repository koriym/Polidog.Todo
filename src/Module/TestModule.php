<?php
namespace Polidog\Todo\Module;

use BEAR\Package\AbstractAppModule;
use Ray\AuraSqlModule\AuraSqlModule;

class TestModule extends AbstractAppModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = $this->appMeta->appDir;
        require_once $appDir . '/env.php';

        [$host, $db, $user, $password, $charset] = [
            getenv('DB_HOST'),
            getenv('DB_NAME') . '_test',
            (string) getenv('DB_USER'),
            (string) getenv('DB_PASS'),
            getenv('DB_CHARSET'),
        ];

        // install testing data
        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        $this->install(new AuraSqlModule($dsn, $user, $password));
    }
}
