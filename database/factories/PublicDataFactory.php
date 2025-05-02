<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicData>
 */
class PublicDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->randomNumber(),
            'user_id' => fake()->randomNumber(),
            'title' => fake()->realText(20),
            'desc' => fake()->text(fake()->numberBetween(100, 140)),
            'status' => fake()->randomElement([0, 1]),
            'due_date' => fake()->date(),
            'done_date' => fake()->date(),
        ];
    }
}
