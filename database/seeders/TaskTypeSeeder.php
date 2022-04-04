<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO task_types (spanish,short_spanish,english,short_english) VALUES
        ('Diseño Gráfico', 'DisGraf','Graphic Design','GraDes'),
        ('Redes Sociales', 'RedSoc','Social Media','SocMed'),
        ('Diseño Web', 'DisWeb','Web Design','WebDes'),
        ('Imprenta', 'Impren','Printing','Print'),
        ('Campañas publicitarias','CampPub','Ad Compagins','AdCompa'),
        ('Estrategia','Estrat','Strategy','Strat'),
        ('IT/Software','ItSoft','IT/Software','ItSoft'),
        ('Eventos/Activaciones','EveAct','Events/Activations','EveAct'),
        ('Derechos Reservados','DerRes','Copyright','CopRig'),
        ('App Ui/Ux','AppUiUX','App Ui/Ux','AppUiUx'),
        ('Contabilidad','Contab','Accounting','Account'),
        ('Video','Video','Video','Video'),
        ('Entrenamiento','Entrena','Training','Train'),
        ('Contenido','Conten','Content','Content'),
        ('Otro','Otro','Other','Other')";


        DB::update ($sql);
    }
}
