<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Female','Male']);
        $fecha_final = new Carbon('2015-12-31');

        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name'  => $this->faker->lastname(),
            'birthday'   => $fecha_final->subDays(random_int(0, 2550))->format('Y/m/d'),
            'gender'     => $gender,
            'user_id'    => 3,
        ];
    }


}
