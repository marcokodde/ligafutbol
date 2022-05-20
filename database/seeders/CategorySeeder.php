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

        $sql="INSERT INTO `categories` VALUES
        (1, '2005', '2005-01-01', '2007-12-31', 'Both', 1),
        (2, '2006', '2006-01-01', '2008-12-31', 'Both', 1),
        (3, '2007', '2007-01-01', '2009-12-31', 'Both', 1),
        (4, '2008', '2008-01-01', '2010-12-31', 'Both', 1),
        (5, '2009', '2009-01-01', '2011-12-31', 'Both', 1),
        (6, '2010', '2010-01-01', '2012-12-31', 'Both', 1),
        (7, '2011', '2011-01-01', '2013-12-31', 'Both', 1),
        (8, '2012', '2012-01-01', '2014-12-31', 'Both', 1),
        (9, '2013', '2013-01-01', '2015-12-31', 'Both', 1),
        (10, '2014', '2014-01-01', '2016-12-31', 'Both', 1),
        (11, '2015', '2015-01-01', '2017-12-31', 'Both', 1),
        (12, 'FEMENIL', '2005-07-17', '2018-12-31', 'Female', 1)";

        DB::update ($sql);
    }
}
