<?php

namespace App\Http\Livewire;

use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Game;
use App\Models\Matche;
use App\Models\Referee;
use App\Models\Tournament;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Matches extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $game_id, $tournament_id, $goals, $hoy;
    public $jornada, $torneo, $juegos, $arbitros;

    public $referee_id = [];

    public function mount()
    {
        //$this->authorize('hasaccess', 'Matches.index');
        $this->manage_title = __('Manage') . ' ' . __('Matchs');

        $this->view_form = 'livewire.matches.form';
        $this->view_table = 'livewire.matches.table';
        $this->view_list  = 'livewire.matches.list';
        $this->search_label = null;
        $this->view_search  = null;
        $this->jornada = Round::where('active', 1)->first();
        $this->torneo = Tournament::where('active', 1)->first();
        $this->juegos = Game::where('round_id', $this->jornada->id)->get();
        $this->arbitros = Referee::all();
        $this->hoy = now();
        $this->allow_create = true;
        $this->pagination = 11;
    }

    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+*/

    public function render()
    {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Match')
            : __('Create') . ' ' . __('Match');

        return view('livewire.index', [
            'records' => Matche::orderby('date')->paginate($this->pagination)
        ]);
    }

    /*+---------------------+
	| Inicializa variables  |
	+----------------------*/

    private function resetInputFields()
    {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['game_id', 'tournament_id', 'referee_id', 'goals']);
    }

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+*/

    public function store()
    {
        $this->validate([
            'game_id' => 'required|min:3|max:30',
            'tournament_id' => 'required|min:3|max:30',
            'referee_id'  => 'required',
            'goals'    => 'required|in:Female,Male',
        ]);

        Matche::updateOrCreate(['id' => $this->record_id], [
            'game_id' => $this->game_id,
            'tournament_id' => $this->tournament_id,
            'referee_id'  => $this->referee_id,
            'goals'    => $this->goals,
            'user_id'   => Auth::user()->id
        ]);

        $this->create_button_label = __('Create') . ' ' . __('Match');
        $this->store_message(__('Match'));
    }

    /*+------------------------------+
	  | Lee Registro Editar o Borar  |
	 +-----------------------------+*/

    public function edit(Matche $record)
    {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Match');
        $this->record       = $record;
        $this->record_id    = $record->id;
        $this->game_id   = $record->game_id;
        $this->tournament_id    = $record->tournament_id;
        $this->referee_id     = $record->referee_id;
        $this->goals       = $record->goals;
        $this->openModal();
    }

    /*+----------------------------+
	| Elimina Registro             |
	+----------------------------+*/
    public function destroy(Matche $record)
    {
        $this->delete_record($record, __('Match') . ' ' . __('Deleted Successfully!!'));
    }
}
