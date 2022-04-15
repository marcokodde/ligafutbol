<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('pruebax',function(){

    echo 'FECHAS DE NACIMIENTO ALEATORIAS' . '<br>';
    for($i=0;$i<=10;$i++){
        $fecha_final = new Carbon('2015-12-31');
        echo $fecha_final->subDays(random_int(0, 2550))->format('Y/m/d') . '<br>';
     }


});


