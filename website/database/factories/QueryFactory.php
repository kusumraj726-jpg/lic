<?php

namespace Database\Factories;

use App\Models\Query;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Query>
 */
class QueryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->randomElement(['Claim Status Update', 'New Policy Inquiry', 'Update Address', 'Payment Issue', 'Policy Renewal Question']),
            'description' => $this->faker->paragraph(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'status' => $this->faker->randomElement(['open', 'in-progress', 'resolved', 'closed']),
        ];
    }
}
