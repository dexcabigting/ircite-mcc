<?php

namespace Tests\Feature\app\HTTP\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_show_endpoint_responds_200()
    {
        $response = $this->get('/management/employee');

        $response->assertStatus(200);
    }
}
