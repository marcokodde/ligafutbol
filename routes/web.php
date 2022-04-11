<?php

use App\Http\Livewire\Categories;
use App\Http\Livewire\Coaches;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Users;
use App\Http\Livewire\Statuses;
use App\Http\Livewire\Permissions;
use App\Http\Livewire\Players;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RolePermissions;
use App\Http\Livewire\Teams;


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
    if (!in_array($locale, ['en', 'es'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    App::setLocale(session()->get('locale'));
    return back();
})->name('changelanguage');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('statuses', Statuses::class)->name('statuses');                      // Estados de registros
    Route::get('permission', Permissions::class)->name('permission');                // Permisos
    Route::get('role', Roles::class)->name('role');                                  // Roles
    Route::get('role-permission', RolePermissions::class)->name('role-permission');  // Asignar Permisos al Rol
    Route::get('users', Users::class)->name('users');                                // Usuarios
    Route::get('categories', Categories::class)->name('categories');                 // Categorías
    Route::get('teams', Teams::class)->name('teams');                                // Equipos
    Route::get('coaches', Coaches::class)->name('coaches');                          // Entrenadores
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
