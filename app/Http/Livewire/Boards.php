<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Board;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Boards extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $title,$description;


    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Boards');
        $this->search_label = "Board Name";
        $this->view_form = 'livewire.boards.form';
        $this->view_table = 'livewire.boards.table';
        $this->view_list  = 'livewire.boards.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Board')
                                                        : __('Create') . ' ' . __('Board');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Board::Title($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['title','description']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'title'         => 'required|min:3',
            'description'   => 'required|min:3',
		]);


		Board::updateOrCreate(['id' => $this->record_id], [
            'title'         => $this->title,
			'description'   => $this->description
		]);

        $this->create_button_label = __('Create') . ' ' . __('Board');
        $this->store_message(__('Board'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Board $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Board');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->title        = $record->title;
		$this->description  = $record->description;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Board $record) {
        $this->delete_record($record,__('Board') . ' ' . __('Deleted Successfully!!'));
    }
}
