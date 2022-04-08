<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'position' => $this->faker->word,
            'sickLeaveCredits' => rand(1, 5),
            'vacationLeaveCredits' => rand(1, 5),
            'hourlyRate' => rand(1000, 9999)
        ];
    }
}
