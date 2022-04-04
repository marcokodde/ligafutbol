<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'board_id'   => Board::all()->random()->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph()
       ];
    }
}
