<?php

namespace Tests\Feature\app\HTTP\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;

class EmployeeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_index_endpoint_responds_200()
    {
        $response = $this->get('api/management/employee');

        $response->assertStatus(200);
    }

    public function test_if_store_endpoint_responds_201()
    {
        $data = [
            'firstName' => 'Pedro',
            'lastName' => 'Batumbakal',
            'position' => 'Supervisor',
            'sickLeaveCredits' => 2,
            'vacationLeaveCredits' => 2,
            'hourlyRate' => 1000,
        ];

        $response = $this->post('api/management/employee', $data);

        $this->assertDatabaseHas('employees', ['firstName' => 'Pedro']);

        $this->assertDatabaseCount('employees', 1);

        $response->assertStatus(201);
    }

    public function test_if_show_endpoint_responds_200()
    {
        $employee = Employee::factory()->create();

        $response = $this->get('api/management/employee' . $employee->id);

        $response->assertStatus(200);
    }

    public function test_if_update_endpoint_responds_201()
    {
        $employee = Employee::factory()->create();

        $data = [
            'firstName' => 'Shanti',
            'lastName' => 'Dope',
            'position' => 'Rapper',
        ];

        $response = $this->put('/api/management/employee/' . $employee->id, $data);

        $this->assertDatabaseHas('employees', $data);

        $this->assertDatabaseCount('employees', 1);

        $response->assertStatus(200);
    }
}
