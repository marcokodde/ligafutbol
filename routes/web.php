<?php

use App\Http\Livewire\Languages;
use App\Http\Livewire\Positions;
use App\Http\Livewire\Statuses;
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

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('statuses', Statuses::class)->name('statuses');                  // Estados de registros
    Route::get('positions',Positions::class)->name('positions');                // Puestos
});
