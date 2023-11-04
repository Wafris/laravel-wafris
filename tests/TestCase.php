<?php

namespace Wafris\Tests;

use Illuminate\Support\Facades\Redis;
use Orchestra\Testbench\TestCase as Orchestra;
use Wafris\AllowRequestMiddleware;
use Wafris\WafrisServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            WafrisServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.redis.client', 'predis');
        config()->set('database.redis.default.database', 3);
        config()->set('database.redis.default.prefix', '');
    }

    protected function prepareRedis()
    {
        $redis = Redis::connection(config('wafris.redis_connection'));
        $redis->flushdb();
        $redis->hset('rules-blocked-p', 'wafris-test', 'Test rule');
    }

    protected function setUpDummyRoutes()
    {
        $this->app['router']->group(
            ['middleware' => AllowRequestMiddleware::class],
            function () {
                $this->app['router']->get('/wafris-test', function () {
                    return 'OK';
                });

                $this->app['router']->get('/wafris', function () {
                    return 'OK';
                });
            }
        );
    }
}
