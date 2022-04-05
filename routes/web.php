<?php

use App\Http\Livewire\Tasks;
use App\Http\Livewire\Boards;
use App\Http\Livewire\Groups;
use App\Http\Livewire\Channels;
use App\Http\Livewire\Statuses;
use App\Http\Livewire\SubTasks;
use App\Http\Livewire\Accordeon;
use App\Http\Livewire\Clients;
use App\Http\Livewire\Positions;
use App\Http\Livewire\TaskTypes;
use App\Http\Livewire\Priorities;
use App\Http\Livewire\Departaments;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Cambio de Lenguaje
Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    App::setLocale(session()->get('locale'));
    return back();
    })->name('changelanguage');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('statuses', Statuses::class)->name('statuses');                  // Estados de registros
    Route::get('positions',Positions::class)->name('positions');                // Puestos
    Route::get('departaments',Departaments::class)->name('departaments');       // Departamentos
    Route::get('priorities',Priorities::class)->name('priorities');             // Prioridades
    Route::get('channels',Channels::class)->name('channels');                   // Canales
    Route::get('tasktypes',TaskTypes::class)->name('tasktypes');                // Tipos de Tarea

    Route::get('clients',Clients::class)->name('clients');                       // Clientes
    Route::get('boards',Boards::class)->name('boards');                         // Tableros
    Route::get('groups',Groups::class)->name('groups');                         // Grupos
    Route::get('tasks',Tasks::class)->name('tasks');                            // Tareas
    Route::get('sub-tasks',SubTasks::class)->name('sub-tasks');                 // Sub Tareas
});

// Route::get('/accordeon', function () {
//     return view('livewire.accordeon');
// })->name('accordeon');

Route::get('accordeon',Accordeon::class)->name('accordeon');

Route::get('get_zipcode/{zipcode}',function($zipcode){

    return json_decode(Http::get('http://virtacc.teamkodde.com/api/get_zipcode/' . $zipcode),true);

})->name('get_zipcode');



