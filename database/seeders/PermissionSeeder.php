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
        ('priorities','priorities.index', 'Priorities List','Listado de Prioridades'),
        ('channels','channels.index', 'Channels List','Listado de Canales'),
        ('positions','positions.index', 'Positions List','Listado de Puestos'),
        ('departaments','departaments.index', 'Departaments List','Listado de Departamentos'),
        ('task_types','task_types.index', 'Task Types List','Listado de Tipos de Tarea'),
        ('clients','clients.index', 'Clients List','Listado de Clientes'),
        ('boards','boards.index', 'Boards List','Listado de Tableros'),
        ('groups','groups.index', 'Groups List','Listado de Grupos'),
        ('tasks','tasks.index', 'Tasks List','Listado de Tareas')";

        DB::update ($sql);
    }
}
