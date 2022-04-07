<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Roles extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

	public $name, $english, $spanish, $full_access;
    public $record_id;

    protected $listeners = ['destroy'];
    // Revisa que tenga acceso
    public function mount()
    {
        //$this->authorize('hasaccess', 'roles.index');
        $this->manage_title = __('Manage') . ' ' . __('Roles');
        $this->search_label = "Role Name";
        $this->view_form    = 'livewire.roles.form';
        $this->view_table   = 'livewire.roles.table';
        $this->view_list    = 'livewire.roles.list';
        $this->resetInputFields();
    }


	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Role')
                                                        : __('Create') . ' ' . __('Role');

        if(App::isLocale('en')){
            return view('livewire.index', [
                'records' => Role::English($this->search)
                            ->paginate($this->pagination),
            ]);
        }
        return view('livewire.index', [
            'records' => Role::Spanish($this->search)
                            ->paginate($this->pagination),
        ]);
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	private function resetInputFields() {
		$this->name     = '';
        $this->english  = '';
        $this->spanish  = '';
        $this->full_access = false;
        $this->record_id = '';
	}


	public function store() {

        $this->validate([
            'name'               => 'required|max:100',
            'english'   => 'required',
            'spanish'               => 'required|max:100',
        ]);

            if(!Auth::user()->isAdmin()){
                $this->full_access = false;
            }

		Role::updateOrCreate(['id'  => $this->record_id], [
			'name'               => $this->name,
            'english'   => $this->english,
            'spanish'               => $this->spanish,
			'full_access'           => $this->full_access ? 1 : 0
		]);

        $this->create_button_label = __('Create') . ' ' . __('Role');
        $this->store_message(__('Role'));

        $this->closeModal();
        $this->resetInputFields();
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public function edit(Role $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Role');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->english = $record->english;
        $this->name = $record->name;
        $this->spanish = $record->spanish;
		$this->full_access = $record->full_access;
		$this->openModal();
	}

	/*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Role $record) {
        $this->delete_record($record,__('Role') . ' ' . __('Deleted Successfully!!'));
    }
}
