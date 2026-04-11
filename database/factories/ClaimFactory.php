<?php

namespace Database\Factories;

use App\Models\Claim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Claim>
 */
class ClaimFactory extends Factory
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
            'claim_amount' => $this->faker->randomFloat(2, 5000, 500000),
            'incident_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['submitted', 'pending', 'approved', 'rejected']),
            'description' => $this->faker->sentence(),
        ];
    }
}
