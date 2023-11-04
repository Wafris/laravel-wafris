<?php

namespace Wafris\Tests;

class AllowRequestMiddlewareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDummyRoutes();
    }

    /** @test */
    public function it_can_call_wafris()
    {
        $response = $this->call('get', 'protected');
        echo $response->getContent();
        dd($response);
    }
}
