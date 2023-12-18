<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PowerLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'power_id' => fake()->randomElement([0,1,2,3,4,5,6,7,8,9]),
            'hero_id' => fake()->randomElement([0,1,2,3,4,5,6,7,8,9])
        ];
    }
}
