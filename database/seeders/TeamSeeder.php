<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Team::factory(30)->create();
        $sql= "INSERT INTO teams  (NAME,category_id,user_id) VALUES
            ('Cruz Azul 2006',3,3),
            ('Cruz Azul 2007',4,3),
            ('Cruz Azul 2008',5,3),
            ('Cruz Azul 2009',6,3),
            ('Cruz Azul 2010',7,3),
            ('Cruz Azul 2011',8,3),
            ('Cruz Azul 2012',9,3),
            ('Cruz Azul 2013',10,3),
            ('Cruz Azul 2014',11,3),
            ('Cruz Azul 2015',12,3),
            ('Cruz Azul Femenil',13,3)";

        DB::update ($sql);



    }
}
