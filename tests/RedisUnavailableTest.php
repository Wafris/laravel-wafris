<?php

namespace Wafris\Tests;

class RedisUnavailableTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDummyRoutes();
    }

    public function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        config()->set('database.redis.default.host', 'invalid.local');
    }

    /** @test */
    public function requests_allowed_if_redis_down()
    {
        $response = $this->call('get', 'wafris-test');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
