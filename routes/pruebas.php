<?php

use App\Http\Livewire\TestController;
use App\Models\Category;
use App\Models\CostByTeam;
use App\Models\Payment;
use App\Models\TeamCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('pruebax',function(){
   // dd('Estas en el');
   $antes = Payment::all()->count();
   $payment = Payment::create([
        'amount'        => 1.00,
        'description'   => 'Prueba',
        'user_id'       => 1,
        'promoter_id'   => null,
        'source'        => 99
    ]);
    $despues = Payment::all()->count();

    dd('Antes=' . $antes . ' Despues=' . $despues);
});

Route::get('costo_x_equipo',function(){
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

Route::get('test_controller',TestController::class)->name('test_controller');

Route::get('teams_by_category',function(){

    $teams_by_category = TeamCategory::groupBy('category_id')
            ->select('category_id')
            ->selectRaw('sum(qty_teams) as teams')
            ->get();
    if($teams_by_category){
        echo '<table boards="2">';
        echo '<thead><th>Categoría</th><th>Equipos</th>';
        foreach($teams_by_category as $team_by_category){
            $category = Category::findOrFail($team_by_category->category_id);
            echo '<tr><td>' .  $category->name . '</td><td>' .  $team_by_category->teams . '</td></tr>';
        }
        echo '</table';
    }
})->name('teams_by_category');
