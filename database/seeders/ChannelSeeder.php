<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO channels (channel,short) VALUES
        ('Social Media', 'SocMed'),
        ('Google Ads', 'GooAds'),
        ('Printing', 'Print'),
        ('Website', 'WebSit'),
        ('Video', 'Video'),
        ('App', 'App'),
        ('Internal', 'Intern'),
        ('Digital', 'Digit')";

        DB::update ($sql);
    }

}
