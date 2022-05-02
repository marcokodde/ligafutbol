<?php

namespace App\Http\Livewire;

use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class AddPlayer extends Component
{
    public $first_name,$last_name,$birthday,$gender;


    public $team,$user;
    public $birthday_min,$birthday_max;

    public function mount(Team $team,User $user){
        $this->team = $team;
        $this->user = $user;
        $this->birthday_min = now();
        $this->birthday_max = now();

    }

    public function render()
    {
        return view('livewire.register_players.add-player');
    }


    /*+------------------------+
	  | Inicializa variables  |
	  +-----------------------+
    */

	private function resetInputFields() {
        $this->reset(['first_name','last_name','birthday','gender']);
	}

    public function addPlayer(){

        $this->validate([
            'first_name'=> 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'birthday'  => 'required',
            'gender'    => 'required|in:Female,Male',
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
