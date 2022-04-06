<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sql= "INSERT INTO permissions (name,slug,english,spanish) VALUES
        ('statuses','statuses.index', 'Statuses List','Listado de Estados'),
        ('areas','areas.index', 'Areas List','Listado de Areas')";

        DB::update ($sql);
    }
}
