<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\drivers;

class DriverTest extends TestCase
{
    use RefreshDatabase; //Don't run on live server
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_driver_api()
    {
        //Preperation /Prepare
        drivers::create([
            'username'  =>  'Driver Myo',
            'email'     =>  'myo@gmail.com',
            'password'  =>  'password'
        ]);

        //Action
        $response = $this->get('/api/drivers'); //use for page

        //Assertion
        $response->assertStatus(200);

        $response->assertSee('drivers'); // check text in page
        $response->assertDontSee('No Driver');
    }
    public function test_driver_api_empty()
    {
        //Action
        $response = $this->get('/api/drivers'); //use for page

        //Assertion
        $response->assertStatus(200);

        $response->assertSee('No Driver'); // check text in page
    }
}
