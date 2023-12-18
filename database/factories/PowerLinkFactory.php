<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PowerLink;

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
        do {
            // Generate a random number
            $randomPower = mt_rand(1, 10);

            $existingRecord = PowerLink::where('power_id', $randomPower)->first();
        } while ($existingRecord);
        do {
            // Generate a random number
            $randomNumber = mt_rand(1, 10);

            $existingRecord = PowerLink::where('hero_id', $randomNumber)->first();
        } while ($existingRecord);
        return [
            'power_id' => $randomPower,
            'hero_id' => $randomNumber
        ];
    }
}
