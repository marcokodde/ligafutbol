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
    public $message;

    public function mount(Team $team,User $user){
        $this->team = $team;
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.add-player');
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

        Player::Create([
            'first_name'=> $this->first_name,
			'last_name' => $this->last_name,
            'birthday'  => $this->birthday,
            'gender'    => $this->gender,
            'user_id'   => $this->user->id
		])->teams()->attach($this->team);

        $this->resetInputFields();


    }
}
