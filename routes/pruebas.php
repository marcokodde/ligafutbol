<?php

use App\Models\CostByTeam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('pruebax',function(){
    echo 'Tabla de importe según cantidad de equipos' . '<br>';
    echo '<table border="1">';
    echo '<thead>
        <tr>Equipos</tr>
        <tr>Costo x Equipo</tr>
        <tr>Importe Total</tr>
    </thead>';
    for($i=1;$i<=15;$i++){

        $sql ="SELECT cost FROM cost_by_teams WHERE " . $i . ' BETWEEN min AND max';
        $records = DB::select($sql);

        if(count($records)){
            echo '<tr>';
                foreach ($records as $record) {
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $record->cost . '</td>';
                    echo '<td>' . $record->cost * $i . '</td>';
                    echo '</td>';
                }
            echo '</tr>';
        }

    }

    echo '</table>';

});


