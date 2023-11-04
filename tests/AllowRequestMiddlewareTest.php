<?php

namespace Wafris\Tests;

class AllowRequestMiddlewareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->prepareRedis();
        $this->setUpDummyRoutes();
    }

    /** @test */
    public function can_not_access_blocked_page()
    {
        $response = $this->call('get', 'wafris-test');
        $this->assertEquals(403, $response->getStatusCode());
    }

    /** @test */
    public function can_access_other_page()
    {
        $response = $this->call('get', 'wafris');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
