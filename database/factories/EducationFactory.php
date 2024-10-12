<?php

namespace Database\Factories;

use Faker\Provider\ka_GE\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->sentence,
            'university' => $this->faker->sentence,
            'date' => "2024/2/10"
        ];
    }
}
