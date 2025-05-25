<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(2),
            'shop_details' => fake()->name(),
            'payment_type' => fake()->randomElement(['cash', 'online']),
            'unit_price' => fake()->randomElement([1000, 4000, 7000, 2500, 10000]),
            'quantity' => fake()->randomElement([1, 5, 8, 9, 25]),
            'total_price' => fake()->randomElement([1000, 40000, 12000, 20000]),
            'photo' => fake()->imageUrl(100, 100, 'user', true, 'photos'),
            'payment_settled' => fake()->boolean(),
        ];
    }
}
