<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInfo>
 */
class PersonalInfoFactory extends Factory
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
            'line' => $this->faker->sentence,
            'image' => $this->faker->sentence,
            'my_number' => $this->faker->sentence,
            'linkedIn' => $this->faker->sentence,
            'github' => $this->faker->sentence,
            'about_me' => $this->faker->sentence,
            'cv' => $this->faker->sentence,
            'email' => $this->faker->sentence,
            'knowledge' =>json_encode(['laith','ammar']),
        ];
    }
}
