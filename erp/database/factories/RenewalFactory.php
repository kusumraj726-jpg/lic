<?php

namespace Database\Factories;

use App\Models\Renewal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Renewal>
 */
class RenewalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'policy_number' => 'POL-' . strtoupper($this->faker->bothify('??###')),
            'policy_type' => $this->faker->randomElement(['Life Insurance', 'Health Insurance', 'Vehicle Insurance', 'Term Plan']),
            'premium_amount' => $this->faker->randomFloat(2, 2000, 50000),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+60 days')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'notified', 'renewed', 'lapsed']),
        ];
    }
}
