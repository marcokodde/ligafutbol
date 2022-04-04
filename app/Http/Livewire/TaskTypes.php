<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\TaskType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class TaskTypes extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $english,$spanish,$short_spanish,$short_english;
    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Task Type');
        $this->search_label =  __('Task Type');
        $this->view_form = 'livewire.tasktypes.form';
        $this->view_table = 'livewire.tasktypes.table';
        $this->view_list  = 'livewire.tasktypes.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Task Type')
                                                        : __('Create') . ' ' . __('Task Type');

        $searchTerm = '%' . $this->search . '%';


        return view('livewire.index', [
            'records' => TaskType::TaskType($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['spanish','short_spanish','english','short_english']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {
		$this->validate([
            'spanish'       => 'required|min:3|max:30|unique:task_types,spanish,' . $this->record_id,
            'short_spanish' => 'required|min:3|max:10 |unique:task_types,short_spanish,' . $this->record_id,
            'english'       => 'required|min:3|max:30|unique:task_types,english,' . $this->record_id,
            'short_english' => 'required|min:3|max:10 |unique:task_types,short_english,' . $this->record_id,
		]);

		TaskType::updateOrCreate(['id' => $this->record_id], [
            'spanish'       => $this->spanish,
			'short_spanish' => $this->short_spanish,
            'english'       => $this->english,
            'short_english' => $this->short_english
		]);

        $this->create_button_label = __('Create') . ' ' . __('Task Type');
        $this->store_message(__('Task Type'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(TaskType $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Task Type');
        $this->record= $record;
		$this->record_id = $record->id;
		$this->english = $record->english;
		$this->spanish = $record->spanish;
        $this->short_spanish = $record->short_spanish;
        $this->short_english = $record->short_english;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(TaskType $record) {

        $this->delete_record($record,__('Task Type') . ' ' . __('Deleted Successfully!!'));
    }
}



