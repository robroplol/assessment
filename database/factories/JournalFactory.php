<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journal>
 */
class JournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $revenue = $this->faker->numberBetween(1000, 3000);
        $food_cost = $this->faker->numberBetween(200, 400);
        $labor_cost = $this->faker->numberBetween(300, 1000);
        $profit = $revenue - ($food_cost + $labor_cost);
        if ($profit < 0) {
            $profit= 0;
        }

        return [
            'date' => date( "Y-m-d"),
            'revenue' => $revenue,
            'food_cost' => $food_cost,
            'labor_cost' => $labor_cost,
            'profit' => $profit,
        ];
    }
}
