<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql ="INSERT INTO positions (spanish,short_spanish,english,short_english) VALUES
       ('Gerente De Cuentas','GerCta','Account Manager','AccMan'),
       ('Diseñador Grafico','DisGra','Graphic Designer','GraDes'),
       ('Representante de Redes Sociales','RedSoc','Social Media Representative','SocMed'),
       ('Escritor de Contenido','EscCon','Content Writer','ConWri'),
       ('Representante de Ventas','RepVen','Sales Representative','SalRep'),
       ('Líder Creativo','LidCre','Creative lead','CreLea'),
       ('Director Creativo','DirCre','Creative Director','CreDir'),
       ('Director de Operaciones','DirOpe','Director of Operations','DirOpe'),
       ('Director de Estrategia','DirEst','Strategy Director','StrDir'),
       ('Recursos Humanos','RecHum','Human Resources','HumRes'),
       ('Desarrollador','Desarr','Developer','Develo'),
       ('Administrador de La Comunidad','AdmCom','Community Manager','ComMan'),
       ('Gerente de Desarrollo de Negocios','GerNeg','Business Development Manager','BusDev')";


        DB::insert($sql);

    }
}
