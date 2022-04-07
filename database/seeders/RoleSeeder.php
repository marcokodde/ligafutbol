<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO roles (name,english,spanish,full_access) VALUES
                ('admin', 'General Admin','Administrador General',1),
                ('support', 'Soporte', 'Soporte', 0),
                ('coach', 'Coach', 'Entrenador', 0)";

        DB::update ($sql);

    }
}
