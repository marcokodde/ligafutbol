<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO statuses (spanish,short_spanish,english,short_english) VALUES
        ('Activo', 'Activ','Active','Activ'),
        ('Inactivo', 'Inact','Inactive','Inact'),
        ('Terminado', 'Term','Finished','Fini')";
        DB::update ($sql);
    }
}
