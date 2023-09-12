<?php

namespace Tests\Unit;

use Tests\TestCase;

class PerformanceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCriticalRouteResponseTime()
    {
        $route = '/';

        $this->withoutExceptionHandling();

        $response = $this->get($route);

        $response->assertStatus(200);

        $responseTime = $response->headers->get('x-response-time');
        $this->assertLessThan(1000, $responseTime);
    }
}
