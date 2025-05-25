<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\student>
 */
class studentFactory extends Factory
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
            'class' => fake()->randomElement(['Nurssery', 'LKG', 'UKG', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th',]),
            'section' => fake()->randomElement(['A', 'B', 'C']),
            'total_fees' => fake()->randomElement([30000, 50000]),
            'fees_due' => fake()->randomElement([0, 20000, 5000, 30000]),
            'fees_settle' => fake()->boolean(),
        ];
    }
}
