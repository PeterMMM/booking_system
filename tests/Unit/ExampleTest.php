<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_check_check_driver()
    {
        // $this->assertTrue(true);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
