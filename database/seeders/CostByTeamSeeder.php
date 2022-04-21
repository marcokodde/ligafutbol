<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostByTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cost_by_teams')->truncate();
        $sql = "INSERT INTO cost_by_teams (min,max,cost) VALUES
            (1,3,200),
            (4,5,180),
            (6,10,175),
            (11,99,150)";
        DB::update ($sql);
    }
}
