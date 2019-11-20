<?php
namespace Polidog\Todo\Module;

use BEAR\Package\Context\ProdModule as PackageProdModule;
use BEAR\QueryRepository\CacheVersionModule;
use BEAR\QueryRepository\StorageApcModule;
use BEAR\QueryRepository\StorageRedisModule;
use BEAR\Resource\Module\OptionsMethodModule;
use Ray\Di\AbstractModule;

class ProdModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new StorageApcModule);
        $redisHost = getenv('REDIS_HOST');
        if (! empty($redisHost)) {
            $this->override(new StorageRedisModule($redisHost));
        }

        $cacheContext = getenv('CACHE_CONTEXT');
        $this->install(new PackageProdModule);
        $this->install(new OptionsMethodModule);
        $this->install(new CacheVersionModule($cacheContext . '.1'));
    }
}
