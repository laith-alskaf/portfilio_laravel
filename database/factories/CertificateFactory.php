<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'disc' => $this->faker->sentence,
            'organization' => $this->faker->sentence,
            'date' => '2024/2/2',
            'skills' => $this->faker->sentence,
            'credential' => $this->faker->sentence,
        ];
    }
}
