<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plagas>
 */
class PlagasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
            $optionsname=[
                'Araña',
                'Maltrato',
                'Bottritis',
                'Bellozo',
                'Oidio',
                'Hoja rota',
                'Tallo corto',
            ]; 
            return [
                'name'=> Arr::random($optionsname),
 
            ];
    
    }
}
