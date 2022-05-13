<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\SettingsTrait;
use App\Http\Livewire\Traits\DatesTrait;


class AddPlayer extends Component
{
    use CrudTrait;
    use SettingsTrait;
    use DatesTrait;
    public $first_name,$last_name,$birthday,$gender;


    public $team,$user;
    public $birthday_min,$birthday_max;
    public $birth_year,$birth_month,$birth_day;
    protected $rules = [
        'first_name'=> 'required|min:3|max:30',
        'last_name' => 'required|min:3|max:30',
        'gender'    => 'required|in:Female,Male',
    ];

    public function mount(Team $team,User $user){
        $this->team = $team;
        $this->user = $user;
        $this->readSettings();
    }

    public function render()
    {
        return view('livewire.register_players.add-player');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    /*+------------------------+
	  | Inicializa variables  |
	  +-----------------------+
    */

	private function resetInputFields() {
        $this->reset(['first_name','last_name','birthday','gender']);
	}

    public function addingPlayer(){

       // $this->birthday     = $this->birth_year . '-' . $this->birth_month . '-' . $this->birth_day;


        $max_birthday = New Carbon($this->birthday_max);
        $min_birthday = New Carbon($this->birthday_min);
        $max_birthday=$max_birthday->format('Y-m-d');
        $min_birthday=$min_birthday->format('Y-m-d');
        // dd('Antes de validar fecha nacimiento dropdwons= ' . $this->birthday2, 'Desde calendario=' . $this->birthday);
        $this->validate([
            'birthday'  => 'required|date|before:' .  $max_birthday .'|after:' . $min_birthday . '',
		]);

        $this->first_name = ucwords(strtolower(trim($this->first_name)));
        $this->last_name = ucwords(strtolower(trim($this->last_name)));

        // ¿Existe el jugador?
        $record_player = Player::ThisUserId($this->user->id)
                                ->FirstName($this->first_name)
                                ->LastName($this->last_name)
                                ->Gender($this->gender)
                                ->Birthday($this->birthday)
                                ->first();
        if(!$record_player){
            Player::Create([
                'first_name'=> $this->first_name,
                'last_name' => $this->last_name,
                'birthday'  => $this->birthday,
                'gender'    => $this->gender,
                'user_id'   => $this->user->id
            ])->teams()->attach($this->team);
        }else{
            $record_player->teams()->detach($this->team);
            $record_player->teams()->attach($this->team);
        }

        $this->team->load('players');

        if ($this->team->players->count() < $this->general_settings->max_players_by_team) {
        } else {
            $this->dispatchBrowserEvent('fill_roster',[
                'title' => __('You have reached the limit of players per team.'),
                'text'  => __('You can remove some and add new ones.'),
                'type'  => 'success'
            ]);
        }
        sleep(2);
        $this->resetInputFields();
        $this->emit('reload_players');

    }

      /*+-----------------------+
	    | Fechas Límite         |
	    +-----------------------+
    */
    public function birthday_limits(){
        $this->birthday_min = $this->team->category->birthday_limits($this->gender,'from');
        $this->birthday_max = $this->team->category->birthday_limits($this->gender,'to');

    }

}
