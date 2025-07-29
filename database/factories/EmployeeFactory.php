<?php

namespace Database\Factories;

use App\Models\Division;
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
            'image' => 'https://i.pravatar.cc/150?u=' . $this->faker->uuid,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'position' => $this->faker->jobTitle(),
        ];
    }
}
