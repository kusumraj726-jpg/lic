<?php
 
namespace Database\Factories;
 
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class StaffFactory extends Factory
{
    protected $model = Staff::class;
 
    public function definition()
    {
        return [
            'user_id' => User::first()?->id ?? User::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'designation' => $this->faker->jobTitle,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
