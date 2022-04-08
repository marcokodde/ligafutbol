<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql= "INSERT INTO categories (name,date_from,date_to,gender) VALUES
        ('2004', '2004-07-17','2004-12-31','Both'),
        ('2005', '2005-01-01','2005-12-31','Both'),
        ('2006', '2006-01-01','2006-12-31','Both'),
        ('2007', '2007-01-01','2007-12-31','Both'),
        ('2008', '2008-01-01','2008-12-31','Both'),
        ('2009', '2009-01-01','2009-12-31','Both'),
        ('2010', '2010-01-01','2010-12-31','Both'),
        ('2011', '2011-01-01','2011-12-31','Both'),
        ('2012', '2012-01-01','2012-12-31','Both'),
        ('2013', '2013-01-01','2013-12-31','Both'),
        ('2014', '2014-01-01','2014-12-31','Both'),
        ('2015', '2015-01-01','2015-12-31','Both'),
        ('FEMENIL', '2004-07-17','2015-12-31','Female')";
        DB::update ($sql);
    }
}
