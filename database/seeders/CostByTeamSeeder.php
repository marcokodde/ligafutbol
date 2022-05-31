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
            (1,3,23),
            (4,5,19),
            (6,10,17),
            (11,99,13)";
        DB::update ($sql);
    }
}
