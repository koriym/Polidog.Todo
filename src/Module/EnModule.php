<?php
namespace Polidog\Todo\Module;

use BEAR\Sunday\Module\Constant\NamedModule;
use Ray\Di\AbstractModule;

class EnModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = dirname(dirname(__DIR__));
        $this->install(new NamedModule(require $appDir . '/var/locale/en.php'));
    }
}
