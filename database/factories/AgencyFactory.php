<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address_1' => $this->faker->address(),
            'address_2' => $this->faker->address(),
            'address_3' => $this->faker->address(),
            'postcode' => $this->faker->postcode(),
            'district_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
