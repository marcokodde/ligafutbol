<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO departaments (spanish,short_spanish,english,short_english) VALUES
        ('Ventas', 'Ventas','Sales','Sales'),
        ('Operaciones', 'Operac','Operations','Operac'),
        ('Estrategia', 'Estrat','Strategy','Strat'),
        ('Recursos Humanos', 'Rrhh','Human Resources','HHRR')";

        DB::update ($sql);
    }
}
