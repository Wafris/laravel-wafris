<?php

namespace Wafris\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Wafris\AllowRequestMiddleware;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDummyRoutes();
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