<?php

namespace Wafris\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Wafris\AllowRequestMiddleware;
use Wafris\WafrisServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDummyRoutes();
    }

    protected function getPackageProviders($app)
    {
        return [
            WafrisServiceProvider::class,
        ];
    }

    protected function setUpDummyRoutes()
    {
        $this->app['router']->group(
            ['middleware' => AllowRequestMiddleware::class],
            function () {
                $this->app['router']->get('/protected', function () {
                    return 'Hello world!';
                });
            }
        );
    }
}
