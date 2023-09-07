<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_bookings()
    {
        $response = $this->post('/api/bookings', [
            'customer_id' => 1,
            'driver_id'   => 2,
            'start_time'  => '2023-08-02 01:00',
            'end_time'    => '2023-08-02 02:00',
        ]);

        // Assert the response status code is 200 (OK)
        $response->assertStatus(200);
        dd(response);
        $this->assertTrue(true);
    }
}
