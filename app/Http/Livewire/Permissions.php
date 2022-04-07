<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Permissions extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

	public $name;
    public $slug;
    public $english;
    public $spanish;

    public $record_id;
    protected $listeners = ['destroy'];
    // Revisa que tenga acceso
    public function mount()
    {
        //$this->authorize('hasaccess', 'permissions.index');
        $this->manage_title = __('Manage') . ' ' . __('Permissions');
        $this->create_button_label = "Create Permission";
        $this->search_label = "Permission Name";
        $this->view_form    = 'livewire.permissions.form';
        $this->view_table   = 'livewire.permissions.table';
        $this->view_list    = 'livewire.permissions.list';
    }
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Permission')
                                                            : __('Create') . ' ' . __('Permission');
		$searchTerm = '%' . $this->search . '%';

        if(App::isLocale('en')){
            return view('livewire.index', [
                'records' => Permission::English($this->search)->paginate($this->pagination),
            ]);
         }

        return view('livewire.index', [
            'records' => Permission::Spanish($this->search)->paginate($this->pagination),
        ]);
	}


	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset([
            'name',
            'slug',
            'english',
            'spanish',
        ]);
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public function store() {
		$this->validate([
            'name'      =>  'required|min:3, max:100',
            'slug'      =>  'required|min:3, max:100|unique:permissions,slug,' . $this->record_id,
            'spanish'   =>  'required|min:3, max:100',
            'english'   =>  'required|min:3, max:100'
		]);


		Permission::updateOrCreate(['id' => $this->record_id], [
            'name'   => $this->name,
            'slug'      => $this->slug,
            'spanish'   => $this->spanish,
            'english' => $this->english,
		]);

        $this->create_button_label = __('Create') . ' ' . __('Permission');
        $this->store_message(__('Permission'));
        $this->resetInputFields();
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public function edit(Permission $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Permission');
        $this->record       = $record;
		$this->record_id    = $record->id;
        $this->name = $record->name;
        $this->slug = $record->slug;
        $this->english = $record->english;
        $this->spanish = $record->spanish;
		$this->openModal();
	}


	/*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Permission $record) {
        $this->delete_record($record,__('Permission') . ' ' . __('Deleted Successfully!!'));
    }
}
