<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_bookings_api()
    {

        $response = $this->get('/api/bookings?driver_id=1'); //use for page

        $response->assertStatus(200);

        $response->assertSee('bookings'); // check text in page
    }
    
}
