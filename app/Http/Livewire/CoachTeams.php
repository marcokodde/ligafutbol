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

class CoachTeams extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use UserTrait;

    public $coaches,$coach,$coach_id;

    public function mount() {
        //$this->authorize('hasaccess', 'role-permissions.index');
        $this->manage_title = "Assign Coach To Teams";
        $this->search_label = "Search Team";
        $this->read_coaches();
	}

    public function render()
    {
        if($this->only_linked){
                return view('livewire.coaches.assign_coach_to_team', [
                    'records' => $this->coach->teams()
                                ->Name($this->search)
                                ->orderby('name')
                                ->paginate($this->pagination)
                ]);
        }

        return view('livewire.coaches.assign_coach_to_team', [
            'records' => Team::Name($this->search)
                                ->orderby('name')
                                ->paginate($this->pagination)
        ]);
    }

    // Lee a los entrenadores

    public function read_coaches() {
        $this->coaches = Auth::user()->coaches()->get();
        //$this->coaches = Coach::UserId()->get();
       // $this->coaches = Coach::where('user_id', Auth::user()->id)->get();
    }

    public function selectRecord(){
        $this->coach_id = null;
        $this->search =null;
        $this->only_linked = false;
    }

    public function read_coach(){
        $this->coach = null;
        if($this->coach_id){
            $this->coach = Coach::findOrFail($this->coach_id);
        }
    }


    public function linkRecord($id){
        $this->coach->teams()->detach($id);
        $this->coach->teams()->attach($id);

    }

    public function unlinkRecord($id){
        $this->coach->teams()->detach($id);
    }
}
