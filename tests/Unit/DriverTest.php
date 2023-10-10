<?php

namespace Tests\Unit;

use Tests\TestCase;
//use PHPUnit\Framework\TestCase;

class DriverTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->withoutExceptionHandling();
        // preperation / prepare

        // action / perform
        $response = $this->getJson(route('drivers.index'));

        // assertion / predict
        $response->assertStatus(200)
            ->assertJson([
                'drivers'=> []
            ]);
        // $this->assertEquals(1, count($response->json()));
    }
}
