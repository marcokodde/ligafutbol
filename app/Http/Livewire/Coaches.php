<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Coach;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Coaches extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name,$phone;

    public function mount()
    {
        //$this->authorize('hasaccess', 'coaches.index');
        $this->manage_title = __('Manage') . ' ' . __('Coaches');
        $this->search_label = __('Name or Phone');
        $this->view_form = 'livewire.coaches.form';
        $this->view_table = 'livewire.coaches.table';
        $this->view_list  = 'livewire.coaches.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Coach')
                                                        : __('Create') . ' ' . __('Coach');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Coach::User()->Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','phone']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'         => 'required|min:3|max:50'
		]);


		Coach::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->name,
			'phone'     => $this->phone,
            'user_id'   => Auth::user()->id
		]);

        $this->create_button_label = __('Create') . ' ' . __('Coach');
        $this->store_message(__('Coach'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Coach $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Coach');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->name         = $record->name;
		$this->phone        = $record->phone;
		$this->openModal();
	}

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Coach $record) {
        $this->delete_record($record,__('Coach') . ' ' . __('Deleted Successfully!!'));
    }
}
