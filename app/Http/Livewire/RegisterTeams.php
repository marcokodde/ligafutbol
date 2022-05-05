<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use App\Models\Coach;
use Livewire\Component;
use App\Models\TeamCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\ZipcodeTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegisterTeams extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use ZipcodeTrait;

    public $user;
    public $teams_category_user;
    public $teamsCategoriesIds = array();
    public $categoriesIds   = array();
    public $team_names      = array();
    public $team_zipcodes   = array();
    public $error_names     = array();
    public $error_zipcodes  = array();
    public $error_message   = null;
    public $finish          = false;
    public $show_team;

    public function mount($token = null)
    {
        if (!Auth::user()) {
            $this->user = User::TokenRegisterTeams($token)->first();
            if ($this->user) {
                $this->teams_category_user = TeamCategory::UserId($this->user->id)
                    ->WithPendingTeams()
                    ->get();
                $i = 0;
                foreach ($this->teams_category_user as $category) {
                    $i = $this->add_category_id($category, $i);
                }
            }
        }
        $this->show_team = false;
    }

    /*+----------------------------------------------+
	  | Presenta formulario filtrando la búsqueda    |
	  +----------------------------------------------+
    */

    public function render()
    {
        return view('livewire.register_teams.index');
    }

    /*+----------------------------------------------+
	  | Llena Array con los Id de las categorías     |
	  +----------------------------------------------+
    */

    private function add_category_id($category, $indice)
    {
        for ($j = 1; $j <= $category->qty_teams; $j++) {
            $this->categoriesIds[$indice]       = $category->category_id;
            $this->teamsCategoriesIds[$indice]  = $category->id;
            $this->error_names[$indice]         = false;
            $this->error_zipcodes[$indice]      = false;
            $indice++;
        }
        return $indice;
    }


    public function review_data()
    {

        $this->validate_fill_arrays();
        if (!$this->error_message) {
            $this->validate_not_duplicate_name_in_array();
        }

        if (!$this->error_message) {
            $this->validate_zipcodes();
        }

        if (!$this->error_message) {
            $this->validate_not_duplicate_name_in_database();
        }

        if (!$this->error_message) {
            $this->create_teams();
        }
    }


    // Todos los datos llenos
    private function validate_fill_arrays()
    {
        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            $this->error_names[$i]      = isset($this->team_names[$i])   ? false : true;
            $this->error_zipcodes[$i]   = isset($this->team_zipcodes[$i]) ? false : true;
        }

        $this->error_message = null;
        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            if ($this->error_names[$i] || $this->error_zipcodes[$i]) {
                $this->error_message = __('Please fill al input boxes');
            }
        }
    }

    /** Valida que no esté duplicado el nombre en la misma categoría  */
    private function validate_not_duplicate_name_in_array()
    {
        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            $this->error_names[$i] = false;
            for ($j = $i + 1; $j < count($this->categoriesIds) - 1; $j++) {
                if ($this->team_names[$i] == $this->team_names[$j] && $this->categoriesIds[$i] == $this->categoriesIds[$j]) {
                    $this->error_message = __('There are duplicate name team');
                    $this->error_names[$i] = true;
                    break;
                }
                if ($this->error_message) break;
            }
        }
    }

    /** Valida que los Zipcode Existan  */
    private function validate_zipcodes()
    {
        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            $this->error_zipcodes[$i] = false;
            $record_zipcode = $this->read_this_zipcode($this->team_zipcodes[$i]);
            if (!$record_zipcode) {
                $this->error_zipcodes[$i] = true;
                $this->error_message = __('Zipcode does not Exists');
                break;
            }
        }
    }


    /** Valida que no existan en base de datos */
    private function validate_not_duplicate_name_in_database()
    {
        $indices = array();
        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            $indices[$i] = 'Buscar' . $this->team_names[$i] . ' Con la categoría ' . $this->categoriesIds[$i];
            $this->error_names[$i] = true;
            $record_team = Team::ByCategory($this->categoriesIds[$i])->Team($this->team_names[$i])->first();
            if ($record_team) {
                $this->error_names[$i] = true;
                $this->error_message = __('The team already exists in category');
                break;
            }
        }
    }

    /** Agrega los equipos */
    private function create_teams()
    {

        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            $record_team_category = TeamCategory::findOrFail($this->teamsCategoriesIds[$i]);
            $record_team = Team::create([
                'name'          => $this->team_names[$i],
                'category_id'   => $this->categoriesIds[$i],
                'zipcode'       => $this->team_zipcodes[$i],
                'user_id'       => $this->user->id,
                'active'        => 1,
                'enabled'       => 1,
                'payment_id'    => $record_team_category->payment_id,
                'amount'        => round($record_team_category->payment->amount / $record_team_category->payment->source, 2),
            ]);

            $record_team_category->update_registered_teams();
            $record_coach = Coach::where('name', $this->user->name)
                ->where('phone', $this->user->phone)
                ->where('user_id', $this->user->id)
                ->first();

            $record_team->coaches()->attach($record_coach);
            $this->store_players(__('Teams'));
        }

        $this->error_message = null;
        $this->finish = true;
        $this->user->delete_token_to_register_teams();
        for ($i = 0; $i < count($this->categoriesIds); $i++) {
            $this->error_names[$i]      = false;
            $this->error_zipcodes[$i]   = false;
        }
        $this->show_team = true;
    }
}
