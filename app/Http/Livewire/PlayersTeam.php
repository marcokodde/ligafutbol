<?php

namespace App\Http\Livewire;


use Carbon\Carbon;
use App\Models\Team;
use App\Models\Player;
use Livewire\Component;
use App\Traits\UserTrait;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PlayersTeam extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use UserTrait;


    private $female_birthday_from,$female_birthday_to;
    private $male_birthday_from,$male_birthday_to;
    public $teams, $team, $team_id;


    public function mount() {
        //$this->authorize('hasaccess', 'role-permissions.index');
        $this->manage_title = "Assign Players To Team";
        $this->search_label = "Search Player";
        $this->read_teams();
	}

    public function render()
    {
           $records =  $this->players_to_assign();
        return view('livewire.teams.assign_players_to_team', [
            'records' => $records
        ]);

    }

    /*+--------------------------------------+
      | Lee jugadores suceptibles de asignar |
      +--------------------------------------+
    */
    private function players_to_assign()
    {
        // Solo ligados
        if($this->only_linked){
            return $this->team->players()
                    ->Name($this->search)
                    ->orderby('last_name')
                    ->orderby('first_name')
                    ->paginate($this->pagination);
        }

        // Categoría de un solo sexo

        if($this->team && $this->team->category->gender != 'Both'){
            if($this->team->category->gender == 'Female'){
                $date_from = $this->female_birthday_from;
                $date_to    = $this->female_birthday_to;
            }else{
                $date_from  = $this->male_birthday_from;
                $date_to    = $this->male_birthday_to;
            }

            return Player::UserId()
                    ->Name($this->search)
                    ->Gender($this->team->category->gender)
                    ->BirthDay($date_from,$date_to)
                    ->orderby('last_name')
                    ->orderby('first_name')
                    ->paginate($this->pagination);
        }

        // Categoría de Ambos sexos
        return Player::UserId()
                    ->Name($this->search)
                    ->where(function($query){
                                $query->where(function($query){
                                                $query->where('gender','Female')
                                                        ->whereBetween('birthday',[$this->female_birthday_from,$this->female_birthday_to]);
                                            })
                                        ->orWhere(function($query){
                                        $query->where('gender','Male')
                                                ->whereBetween('birthday',[$this->male_birthday_from,$this->male_birthday_to]);

                                        });
                            })
                    ->orderby('last_name')
                    ->orderby('first_name')
                    ->paginate($this->pagination);

    }

    // Lee Equipos del Usuario Conctado
    public function read_teams() {
        $this->teams = Team::UserId()->get();
    }


    public function read_team(){

        if($this->team_id){
            $this->team = Team::findOrFail($this->team_id);
            $this->calculate_birthday_limits();
        }
    }


    public function linkRecord($id){
        $this->team->players()->detach($id);
        $this->team->players()->attach($id);
        $this->only_linked = false;
        $this->read_team();

    }

    public function unlinkRecord($id){
        $this->team->players()->detach($id);
        $this->only_linked = false;
        $this->read_team();
    }


    /*+---------------------------------------------+
      | Calcula las fechas de nacimiento límite     |
      +---------------------------------------------+
     */
    private function calculate_birthday_limits(){

        $date_category_from         = New Carbon($this->team->category->date_from);
        $this->female_birthday_from = $date_category_from->subYear();
        $this->female_birthday_to   = New Carbon($this->team->category->date_to);

        $this->male_birthday_from   = New Carbon($this->team->category->date_from);
        $date_category_from         = New Carbon($this->team->category->date_from);
        $this->male_birthday_to     = $date_category_from->addYears(3);


        // dd('Categoría:'. $this->team->category->name . ' Fechas:' . $this->team->category->date_from . ' -' . $this->team->category->date_to,
        //     'Niñas:'   . $this->female_birthday_from . '-' .  $this->female_birthday_to,
        //     'Niños: '  . $this->male_birthday_from   . '-' .  $this->male_birthday_to);
    }

}