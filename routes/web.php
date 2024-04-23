<?php

use App\Http\Livewire\Games;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Teams;
use App\Http\Livewire\Users;
use App\Http\Livewire\Rounds;
use App\Http\Livewire\Coaches;
use App\Http\Livewire\Payouts;
use App\Http\Livewire\Players;
use App\Http\Livewire\Rosters;
use App\Http\Livewire\Payments;
use App\Http\Livewire\Referees;
use App\Http\Livewire\Settings;

use App\Http\Livewire\Stadiums;
use App\Http\Livewire\Statuses;
use App\Http\Livewire\Promoters;
use App\Http\Livewire\Categories;
use App\Http\Livewire\Exceptions;
use App\Http\Livewire\ClearTables;

use App\Http\Livewire\CoachesTeam;
use App\Http\Livewire\CostsByTeam;
use App\Http\Livewire\Permissions;
use App\Http\Livewire\PlayersTeam;
use App\Http\Livewire\Tournaments;
use App\Http\Livewire\QueryRosters;
use App\Http\Livewire\TeamsQueries;
use Illuminate\Support\Facades\App;

use App\Http\Livewire\RegisterTeams;
use App\Http\Livewire\TeamCategories;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\QuestionAnswers;
use App\Http\Livewire\RegisterPlayers;
use App\Http\Livewire\RolePermissions;
use App\Http\Livewire\AccordeonQuestions;
use App\Http\Livewire\EmailNotifications;
use App\Http\Livewire\TemporalController;
use App\Http\Livewire\TotalTeamsByCategories;
use App\Http\Livewire\ReleaseResponsibilities;
use App\Http\Controllers\ConfirmationController;
use App\Http\Livewire\Matches;

require 'pruebas.php';

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

    Route::get('statuses', Statuses::class)->name('statuses');                      // Estados de registros
    Route::get('permission', Permissions::class)->name('permission');                // Permisos
    Route::get('role', Roles::class)->name('role');                                  // Roles
    Route::get('role-permission', RolePermissions::class)->name('role-permission');  // Asignar Permisos al Rol
    Route::get('users', Users::class)->name('users');                                // Usuarios
    Route::get('categories', Categories::class)->name('categories');                 // Categorías
    Route::get('costs-by-team', CostsByTeam::class)->name('costs-by-team');          // Costos x Equipo
    Route::get('settings', Settings::class)->name('settings');                       // Configuración
    Route::get('costs-by-team', CostsByTeam::class)->name('costs-by-team');          // Costos x Equipo
    // Costos x Equipo
    // Configuraci贸n
    Route::get('referees', Referees::class)->name('referees');                       // Crear Arbitros
    Route::get('stadiums', Stadiums::class)->name('stadiums');                       // Crear Campos
    Route::get('tournaments', Tournaments::class)->name('tournaments');              // Crear Torneos
    Route::get('rounds', Rounds::class)->name('rounds');                             // Rondas (Jornadas)
    Route::get('games', Games::class)->name('games');                                // Juegos
    Route::get('matches', Matches::class)->name('matches');                          // Cedulas


    // Acciones del usuario Coach
    Route::get('teams', Teams::class)->name('teams');                                // Equipos
    Route::get('coaches', Coaches::class)->name('coaches');                          // Entrenadores
    Route::get('players', Players::class)->name('players');                          // Jugadores
    Route::get('coaches-team', CoachesTeam::class)->name('coaches-team');             // Asignar Coach a Equipos
    Route::get('players-team', PlayersTeam::class)->name('players-team');            // Asignar Jugadores a Equipos
    Route::get('promoters', Promoters::class)->name('promoters');            // Asignar Jugadores a Equipos


});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('payments/{promoter_code?}', TemporalController::class)->name('payments');
Route::get('email_notifications', EmailNotifications::class)->name('email_notifications');
Route::get('payments_test/{promoter_code?}', TemporalController::class)->name('payments_test');
Route::post('makepayment', [Payments::class, 'makepayment'])->name('makepayment');

Route::get('rosters', Rosters::class)->name('rosters');
Route::get('team-categories', TeamCategories::class)->name('team-categories');
Route::get('confirmation', [ConfirmationController::class, 'confirmation'])->name('confirmation');
Route::get('questions', QuestionAnswers::class)->name('questions');
Route::get('question-answers', AccordeonQuestions::class)->name('question-answers');


Route::get('register_teams/{token?}', RegisterTeams::class)->name('register_teams');
Route::get('register_players/{token?}', RegisterPlayers::class)->name('register_players');
Route::get('clear_tables', ClearTables::class)->name('clear_tables');
Route::get('error/{message}/{code?}', Exceptions::class)->name('error');
Route::get('release_of_responsibilities', ReleaseResponsibilities::class)->name('release_of_responsibilities');

// Consulta de Equipos
// Usuarios
Route::get('teams_queries', TeamsQueries::class)->name('teams_queries');
Route::get('total_team_categories/{show?}', TotalTeamsByCategories::class)->name('total_team_categories');
// Usuarios

Route::get('payout', Payouts::class)->name('payout');
Route::get('payout/{number_teams?}/{price?}', Payouts::class)->name('payout.get');
Route::post('makepayout', [Payouts::class, 'makepayout'])->name('makepayout');
Route::get('query_rosters', QueryRosters::class)->name('query_rosters');
