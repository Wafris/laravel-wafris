<?php

namespace Wafris\Tests;

use RuntimeException;

class AllowRequestMiddlewareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
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

    /** @test */
    // TODO
    /*public function can_not_use_without_predis_client()
    {
        config()->set('database.redis.client', 'phpredis');
        $this->expectException(RuntimeException::class);
        $this->call('get', 'wafris');
    }*/
}
