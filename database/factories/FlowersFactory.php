<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlowersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $optionsname=[
            'Be Sweet',
            'Brighton',
            'Explorer',
            'Frutteto',
            'Mondial',
            'Playa Blanca',
            'Vendela',
            'High & Magic',
            'Gotcha',
            'Mandala',
            'Orange Crush',
            'Ocean Song',
            'Candelight',
        ];
        $optionsnbloque=[
            'B1',
            'B2',
            'B3',
        ];
       
        return [
            'name'=> Arr::random($optionsname),
            'nbloque'=> Arr::random($optionsnbloque),
        ];
    }
}
