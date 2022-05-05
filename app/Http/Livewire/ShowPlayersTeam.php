<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\Player;
use Livewire\Component;

class ShowPlayersTeam extends Component
{
    public $team;

    protected $listeners = ['reload_players'];

    public function mount(Team $team){
        $this->team = $team;
    }

    public function render()
    {
        return view('livewire.register_players.show-players-team');
    }

    public function removePlayer(Player $player){
        $this->team->players()->detach($player);
        $this->team->load('players');
        $this->emit('reload_players');
    }

    /*+--------------------+
	  | Recarga jugadores  |
	  +--------------------+
    */
    public function reload_players(){
        $this->team = Team::findOrFail($this->team->id);
        $this->team->load('players');
    }
}