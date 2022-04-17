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
        // $sql= "INSERT INTO teams  (name,category_id,zipcode,user_id) VALUES
            // ('Cruz Azul 2004',1,78201,3),
            // ('Cruz Azul 2005',2,78201,3),
            // ('Cruz Azul 2006',3,78201,3),
            // ('Cruz Azul 2007',4,78701,3),
            // ('Cruz Azul 2008',5,75201,3),
            // ('Cruz Azul 2009',6,77001,3),
            // ('Cruz Azul 2010',7,77498.3),
            // ('Cruz Azul 2011',8,75032,3),
            // ('Cruz Azul 2012',9,76301,3),
            // ('Cruz Azul 2013',10,76501,3),
            // ('Cruz Azul 2014',11,77960,3),
            // ('Cruz Azul 2015',12,78010,3),
        //     ('Cruz Azul Femenil',13,78520,3)";
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('teams')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $sql = "INSERT INTO teams (name,category_id,zipcode,user_id) VALUES
            ('Cruz Azul 2004',1,78201,3),
            ('Cruz Azul 2005',2,78201,3),
            ('Cruz Azul 2006',3,78201,3),
            ('Cruz Azul 2007',4,78701,3),
            ('Cruz Azul 2008',5,75201,3),
            ('Cruz Azul 2009',6,77001,3),
            ('Cruz Azul 2010',7,77498,3),
            ('Cruz Azul 2011',8,75032,3),
            ('Cruz Azul 2012',9,76301,3),
            ('Cruz Azul 2013',10,76501,3),
            ('Cruz Azul 2014',11,77960,3),
            ('Cruz Azul 2015',12,78010,3),
            ('Cruz Azul Femenil',13,78520,3)";
        DB::update ($sql);

    }
}
