<?php

namespace App\Http\Livewire;


use App\Models\Team;
use App\Models\Coach;
use Livewire\Component;
use App\Traits\UserTrait;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Teamcoachs extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use UserTrait;

    public $teams, $team, $team_id;

    public function mount() {
        $this->read_teams();
	}

    public function render()
    {
        return view('livewire.coaches.no_assign_coach_to_team', [
            'records' => Coach::UserId($this->search)
                                ->orderby('id')
                                ->paginate($this->pagination)
        ]);
    }

    // Lee a los entrenadores
    public function read_teams() {
        $this->teams = Team::UserId()->get();
    }

    public function selectRecord(){
        $this->team_id = null;
        $this->search =null;
        $this->only_linked = false;
    }

    public function read_team(){
        $this->team = null;
        if($this->team_id){
            $this->team = Coach::findOrFail($this->team_id);
        }
    }

    public function linkRecord($id){
        $this->team->coaches()->detach($id);
        $this->team->coaches()->attach($id);
    }

    public function unlinkRecord($id){
        $this->team->coaches()->detach($id);
    }
}
