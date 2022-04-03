<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO priorities (spanish,short_spanish,english,short_english,priority) VALUES
        ('Urgente', 'Urg','Urgent','Urg',1),
        ('Alta', 'Alt','High','Hig',2),
        ('Media', 'Med','Medium','Med',3),
        ('Baja', 'Baj','Low','Low',4)";

        DB::update ($sql);
    }


}
