<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\Player;
use Livewire\Component;
use App\Http\Livewire\Traits\SettingsTrait;

class ShowPlayersTeam extends Component
{
    use SettingsTrait;
    public $team;

    protected $listeners = ['removePlayer',
                            'reload_players'];

    public function mount(Team $team){
        $this->team = $team;
        $this->readSettings();
    }

    public function render()
    {
        $this->team = Team::findOrFail($this->team->id);
        return view('livewire.register_players.show-players-team');
    }

    public function removePlayer(Player $player){
        $this->team->players()->detach($player);
        $this->team->load('players');
        $this->emit('reload_players');
    }

    /*  +--------------------+
	    | Recarga jugadores  |
	    +--------------------+
    */
    public function reload_players(){
        $this->team = Team::findOrFail($this->team->id);
        $this->team->load('players');
    }
}