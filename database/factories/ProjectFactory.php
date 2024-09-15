<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $startDate = $this->faker->date();
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 years')->format('Y-m-d');

        return [
            'title' => $this->faker->jobTitle(),
            'agency_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'pic_agency' => $this->faker->company(),
            'contract_period' => $this->faker->numberBetween(1, 12),
            'warranty_period' => $this->faker->numberBetween(1, 12),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price' => $this->faker->numberBetween(10000, 1000000),
            'SST_file' => $this->faker->filePath(),
            'notes' => $this->faker->text(),
            'creator' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Berjaya', 'Aktif', 'EOT', 'Tempoh jaminan', 'Selesai']),
        ];
    }
}
