<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Board;
use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Groups extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $board_id,$title,$description;
    public $boards;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Groups');
        $this->search_label = "Group Name";
        $this->view_form = 'livewire.groups.form';
        $this->view_table = 'livewire.groups.table';
        $this->view_list  = 'livewire.groups.list';
        $this->boards     = Board::all();
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Group')
                                                        : __('Create') . ' ' . __('Group');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Group::Title($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['board_id','title','description']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'board_id'      => 'required|not_in:Elegir|not_in:Choose|exists:boards,id',
            'title'         => 'required|min:3',
            'description'   => 'required|min:3',
		]);

    		Group::updateOrCreate(['id' => $this->record_id], [
            'board_id'      => $this->board_id,
            'title'         => $this->title,
			'description'   => $this->description
		]);

        $this->create_button_label = __('Create') . ' ' . __('Group');
        $this->store_message(__('Group'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Group $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Group');
        $this->record       = $record;
		$this->record_id    = $record->id;
        $this->board_id     = $record->board_id;
		$this->title        = $record->title;
		$this->description  = $record->description;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Group $record) {
        $this->delete_record($record,__('Group') . ' ' . __('Deleted Successfully!!'));
    }
}

