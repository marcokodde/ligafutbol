<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->name(),
            'phone'     => $this->faker->e164PhoneNumber(),
          //  'user_id'   => User::all()->random()->id,
            'user_id'   => 3,
        ];
    }
}
