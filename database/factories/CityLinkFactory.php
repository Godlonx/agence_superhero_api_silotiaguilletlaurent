<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CityLink;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CityLinkFactory extends Factory
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
            $randomCity = mt_rand(1, 5);

            $existingRecord = CityLink::where('power_id', $randomCity)->first();
        } while ($existingRecord);
        do {
            // Generate a random number
            $randomNumber = mt_rand(1, 10);

            $existingRecord = CityLink::where('hero_id', $randomNumber)->first();
        } while ($existingRecord);
        return [
            'city_id' => $randomCity,
            'hero_id' => $randomNumber
        ];
    }
}
