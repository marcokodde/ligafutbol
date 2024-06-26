<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Settings extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $name;
    public $max_players_by_team;
    public $max_teams_by_category;
    public $players_only_available_teams;
    public $coaches_only_available_teams;
    public $active_coupon;
    public $key_to_coupon;
    protected $listeners = ['destroy'];




    public function mount()
    {
        $this->authorize('hasaccess', 'settings.index');
        $this->manage_title = __('Manage') . ' ' . __('Settings');
        $this->allow_create = false;
        $this->search_label = Null;
        $this->view_search  = Null;
        $this->view_form    = 'livewire.settings.form';
        $this->view_table   = 'livewire.settings.table';
        $this->view_list    = 'livewire.settings.list';
        $this->show_pagination = false;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Setting')
                                                        : __('Create') . ' ' . __('Setting');

       return view('livewire.index', [
            'records' => Setting::All(),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset([
            'name',
            'max_players_by_team',
            'max_teams_by_category',
            'players_only_available_teams',
            'coaches_only_available_teams',
            'active_coupon',
            'key_to_coupon'
        ]);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

        $this->validate([
            'name'                  => 'required|min:4|max:50|unique:settings,name,' . $this->record_id,
            'max_players_by_team'   => 'required',
            'max_teams_by_category' => 'required'
		]);

		Setting::updateOrCreate(['id' => $this->record_id], [
            'name'                          => $this->name,
			'max_players_by_team'           => $this->max_players_by_team,
			'max_teams_by_category'         => $this->max_teams_by_category,
            'players_only_available_teams'  => $this->players_only_available_teams ? 1 : 0,
            'coaches_only_available_teams'  => $this->coaches_only_available_teams ? 1 : 0,
            'active_coupon'                 => $this->active_coupon ? 1 : 0,
            'key_to_coupon'                 => $this->key_to_coupon,
    	]);

        $this->create_button_label = __('Create') . ' ' . __('Setting');
        $this->store_message(__('Setting'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Setting $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Setting');
        $this->record                       = $record;
		$this->record_id                    = $record->id;
		$this->name                         = $record->name;
		$this->max_players_by_team          = $record->max_players_by_team;
		$this->max_teams_by_category        = $record->max_teams_by_category;
        $this->players_only_available_teams = $record->players_only_available_teams;
        $this->coaches_only_available_teams = $record->coaches_only_available_teams;
        $this->active_coupon                = $record->active_coupon;
        $this->key_to_coupon                = $record->key_to_coupon;

		$this->openModal();
	}


}



