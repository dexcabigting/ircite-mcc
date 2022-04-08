<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()->count(5)->create();   

        Employee::create([
            'id' => 10000,
            'firstName' => 'Gold',
            'lastName' => 'Doe',
            'position' => 'Treasurer',
            'sickLeaveCredits' => 5,
            'vacationLeaveCredits' =>5,
            'hourlyRate' => 200
        ]);
        
    }
}
