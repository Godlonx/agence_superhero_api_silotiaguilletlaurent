<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'gender' => fake()->randomElement(["male","femal"]),
            'hair_color' => fake()->randomElement(['Red','Blue','Brown','Orange','Blond','Bald']),
            'birth_planet' => Str::random(7),
            'description' => Str::random(50),
            'team_id' => fake()->randomElement([0,1,2,3,4,5,6,7,8,9]),
            'transport_way' => fake()->randomElement([0,1,2,3,4,5]),
        ];
    }
}
