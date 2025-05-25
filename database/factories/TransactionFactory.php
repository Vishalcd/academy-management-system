<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'expense_id' => Expense::factory(),
            'transaction_type' => fake()->randomElement(['withdrawal', 'deposit']),
            'transaction_amount' => fake()->randomElement([10000, 30000, 50000]),
            'transaction_method' => fake()->randomElement(['cash', 'online']),
            'transaction_for' => fake()->randomElement(['student_fee', 'employee_salary', 'expense']),
        ];
    }
}
