<?php

namespace Database\Seeders;

use App\Models\Promoter;
use Illuminate\Database\Seeder;

class PromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promoter::factory(1)->create();
    }
}
