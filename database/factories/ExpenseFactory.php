<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            "date" => fake()->date("Y-m-d"),
            "amount" => array_rand([100000, 50000, 120000, 30000, 20000]),
            "category" => array_rand(["Incoming Transfer", "Other Income"]),
            "description" => fake()->sentence(1),
            "wallet" => array_rand(["cash", "bank"]),
            "user_id" => array_rand([1, 2]),
        ];
    }
}
