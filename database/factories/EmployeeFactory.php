<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_title' => fake()->randomElement(['Teacher', 'Clerk', 'Security Guard', 'Bus Driver', 'Receptionist',]),
            'salary' => fake()->randomElement([10000, 30000, 50000]),
            'pending_salary' => fake()->randomElement([10000, 20000]),
            'last_paid' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'salary_settled' => fake()->boolean(),
        ];
    }
}
