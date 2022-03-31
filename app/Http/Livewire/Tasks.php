<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Tasks extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $group_id,$title,$description;
    public $groups;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Tasks');
        $this->search_label = "Task Name";
        $this->view_form    = 'livewire.tasks.form';
        $this->view_table   = 'livewire.tasks.table';
        $this->view_list    = 'livewire.tasks.list';
        $this->groups       = Group::all();
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Task')
                                                        : __('Create') . ' ' . __('Task');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Task::Title($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['group_id','title','description']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'group_id'      => 'required|not_in:Elegir|not_in:Choose|exists:groups,id',
            'title'         => 'required',
            'description'   => 'required',
		]);


		Task::updateOrCreate(['id' => $this->record_id], [
            'group_id'      => $this->group_id,
            'title'         => $this->title,
			'description'   => $this->description
		]);

        $this->create_button_label = __('Create') . ' ' . __('Task');
        $this->store_message(__('Task'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Task $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Task');
        $this->record       = $record;
		$this->record_id    = $record->id;
        $this->group_id     = $record->group_id;
		$this->title        = $record->title;
		$this->description  = $record->description;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Task $record) {
        $this->delete_record($record,__('Task') . ' ' . __('Deleted Successfully!!'));
    }
}

