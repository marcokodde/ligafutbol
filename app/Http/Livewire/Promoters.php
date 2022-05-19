<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Promoter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Promoters extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name,$email,$phone,$code;

    public function mount()
    {
        //$this->authorize('hasaccess', 'Promoteres.index');
        $this->manage_title = __('Manage') . ' ' . __('Promoters');
        $this->search_label = __('Name  - Phone or Email');
        $this->view_form    = 'livewire.promoters.form';
        $this->view_table   = 'livewire.promoters.table';
        $this->view_list    = 'livewire.promoters.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Promoter')
                                                        : __('Create') . ' ' . __('Promoter');


        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Promoter::Search($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','phone','email','code']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'      => 'required|min:3|max:50',
            'phone'     => 'required|min:3|max:15',
            'email'     => 'required|email',
            'code'      => 'required|min:3|max:50',
		]);

		Promoter::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->name,
			'phone'     => $this->phone,
            'email'     => $this->email,
            'code'      => $this->code,
		]);

        $this->create_button_label = __('Create') . ' ' . __('Promoter');
        $this->store_message(__('Promoter'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Promoter $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Promoter');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->name         = $record->name;
		$this->phone        = $record->phone;
        $this->email        = $record->email;
        $this->code         = $record->code;
		$this->openModal();
	}

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Promoter $record) {
        $this->delete_record($record,__('Promoter') . ' ' . __('Deleted Successfully!!'));
    }
}
