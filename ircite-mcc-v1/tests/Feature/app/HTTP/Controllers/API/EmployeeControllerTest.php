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
        $response = $this->get('/api/management/employee');

        $response->assertStatus(200);
    }

    public function test_if_store_endpoint_responds_200()
    {
        $data = [
            'firstName' => 'Pedro',
            'lastName' => 'Batumbakal',
            'position' => 'Supervisor',
            'sickLeaveCredits' => 2,
            'vacationLeaveCredits' => 2,
            'hourlyRate' => 1000,
        ];

        $response = $this->post('/api/management/employee', $data);

        $this->assertDatabaseHas('employees', ['firstName' => 'Pedro']);

        $this->assertDatabaseCount('employees', 1);

        $response->assertStatus(200);
    }

    public function test_if_store_endpoint_responds_on_duplicate_record()
    {
        $data = [
            'firstName' => 'Pedro',
            'lastName' => 'Batumbakal',
            'position' => 'Supervisor',
            'sickLeaveCredits' => 2,
            'vacationLeaveCredits' => 2,
            'hourlyRate' => 1000,
        ];

        Employee::create($data);

        $response = $this->post('/api/management/employee', $data);

        $response->assertStatus(309);
    }

    public function test_if_show_endpoint_responds_200()
    {
        $employee = Employee::factory()->create();

        $response = $this->get('/api/management/employee/' . $employee->id);

        $response->assertStatus(200);
    }

    public function test_if_show_endpoint_responds_404_on_missing_record()
    {
        $response = $this->get('/api/management/employee/' . 5);

        $response->assertStatus(404);
    }


    public function test_if_update_endpoint_responds_200()
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

    public function test_if_update_endpoint_responds_404_on_missing_record()
    {
        $data = [
            'firstName' => 'Shanti',
            'lastName' => 'Dope',
            'position' => 'Rapper',
        ];

        $response = $this->put('/api/management/employee/' . 2, $data);

        $response->assertStatus(404);
    }

    public function test_if_destroy_endpoint_responds_200()
    {
        $employee = Employee::factory()->create();

        $response = $this->delete('/api/management/employee/' . $employee->id);

        $this->assertDatabaseCount('employees', 0);

        $response->assertStatus(200);
    }

    public function test_if_destroy_endpoint_responds_404_on_missing_record()
    {
        $response = $this->delete('/api/management/employee/' . 4);

        $response->assertStatus(404);
    }
}
