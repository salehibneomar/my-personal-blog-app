<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Thick Skull',
            'initial_name' => 'TSK',
            'logo' => 'nai',
            'user_id' => 'S5210',
        ];
    }
}
