<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;
use App\Models\Category;
use App\Models\TeamCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Teams extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name, $category_id, $zipcode, $user_id;
    public $active = 1;
    public $enabled = 1;
    public $categories, $teams, $players;

    public function mount()
    {
        //$this->authorize('hasaccess', 'Teams.index');
        $this->manage_title = __('Manage') . ' ' . __('Teams');
        $this->search_label = 'Team Name';
        $this->view_form = 'livewire.teams.form';
        $this->view_table = 'livewire.teams.table';
        $this->view_list = 'livewire.teams.list';
        $this->view_search = 'livewire.teams.search';
        $this->categories = Category::Active()
            ->orderBy('date_from')
            ->get();
        if (Auth::user()->IsAdmin()) {
            $this->allow_create = false;
        }
    }

    /*+----------------------------------------------+
 | Presenta formulario filtrando la búsqueda    |
 +----------------------------------------------+
 */

    public function render()
    {
        $this->create_button_label = $this->record_id ? __('Update') . ' ' . __('Team') : __('Create') . ' ' . __('Team');

        $searchTerm = '%' . $this->search . '%';
        if (Auth::user()->IsAdmin()) {
            return view('livewire.teams.index', [
                'records' => Team::Name($searchTerm)
                    ->ByCategory($this->category_id)
                    ->paginate($this->pagination),
            ]);
        }
        return view('livewire.index', [
            'records' => Team::UserId()
                ->Name($searchTerm)
                ->paginate($this->pagination),
        ]);
    }

    /*+----------------------+
 | Inicializa variables  |
 +-----------------------+
    */

    private function resetInputFields()
    {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name', 'category_id', 'zipcode', 'active', 'enabled']);
    }

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3|max:50',
            'category_id' => 'required|not_in:Elegir|not_in:Choose|exists:categories,id',
        ]);

        Team::updateOrCreate(
            ['id' => $this->record_id],
            [
                'name' => $this->name,
                'category_id' => $this->category_id,
                'user_id' => Auth::user()->id,
                'active' => $this->active ? 1 : 0,
                'enabled' => $this->enabled ? 1 : 0,
            ],
        );

        //TODO: Probar elAgregar para que sume los equipos por categoría. (lugares disponibles)
        if (!$this->record_id) {
            TeamCategory::create([
                'user_id' => Auth::user()->id,
                'category_id' => $this->category_id,
                'payment_id' => null,
                'qty_teams' => 1,
            ]);
        }

        $this->create_button_label = __('Create') . ' ' . __('Team');
        $this->store_message(__('Team'));
    }

    /*+------------------------------+
 | Lee Registro Editar o Borar  |
 +------------------------------+
 */

    public function edit(Team $record)
    {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Team');
        $this->record = $record;
        $this->record_id = $record->id;
        $this->name = $record->name;
        $this->category_id = $record->category_id;
        $this->zipcode = $record->zipcode;
        $this->active = $record->active;
        $this->enabled = $record->enabled;

        $this->openModal();
    }

    /*+----------------------------+
 | Elimina Registro             |
 +------------------------------+
    */
    public function destroy(Team $record)
    {
        // TODO: Descontar de los equipos por categoría
        $team_category = TeamCategory::where('category_id', $record->category_id)
            ->where('qty_teams', '>', 'registered_teams')
            ->where('user_id', Auth::user()->id)
            ->whereNull('payment_id')
            ->first();

        if ($team_category) {
            $team_category->delete();
            $this->delete_record($record, __('Team') . ' ' . __('Deleted Successfully!!'));
        }
    }


    public function read_teams()
    {
        if ($this->category_id) {
            $this->category = Category::findOrFail($this->category_id);
            $this->teams = $this->category->teams()->get();
        }
    }

    public function read_players()
    {
        if ($this->user_id) {
            $this->team = Team::findOrFail($this->user_id);
            $this->players = $this->team->players()->get();
        }
    }
}
