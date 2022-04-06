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
                ('director', 'Director', 'Director', 0),
                ('DesignLead', 'Design Lead', 'Líder de Diseño',0),
                ('DeptoLead', 'Departament Lead', 'Líder de Departamento', 0),
                ('AccountManager', 'Account Manager', 'Gerente de Cuenta', 0),
                ('SocialAgent', 'Social Media Agent', 'Agente Redes Sociales', 0),
                ('BrandDesigner', 'Diseñador de Marca','Diseñador de Marca', 0),
                ('GraphDesigner', 'Graph Designer','Diseñador Gráfico', 0),
                ('Developer', 'Developer', 'Desarrollador', 0)";

        DB::update ($sql);

    }
}
