<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatmen>
 */
class TreatmenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $options = ['Kecantikan', 'Kesehatan', 'Perawatan'];
        $randomIndex = array_rand($options);
        return [
            'nama' => $options[$randomIndex]
        ];
    }
}
