<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Status;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class Statuses extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $english,$spanish,$short_spanish,$short_english;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Status');
        $this->search_label = "Status Name";
        $this->view_form = 'livewire.statuses.form';
        $this->view_table = 'livewire.statuses.table';
        $this->view_list  = 'livewire.statuses.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Status')
                                                        : __('Create') . ' ' . __('Status');

        $searchTerm = '%' . $this->search . '%';


        if(App::isLocale('en')){
            return view('livewire.index', [
                'records' => Status::English($searchTerm)->paginate($this->pagination),
            ]);
        }

        return view('livewire.index', [
            'records' => Status::Spanish($searchTerm)->paginate($this->pagination),
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
            'spanish'       => 'required|min:3|max:15|unique:statuses,spanish,' . $this->record_id,
            'short_spanish' => 'required|min:3|max:5 |unique:statuses,short_spanish,' . $this->record_id,
            'english'       => 'required|min:3|max:15|unique:statuses,english,' . $this->record_id,
            'short_english' => 'required|min:3|max:5 |unique:statuses,short_english,' . $this->record_id,
		]);

		Status::updateOrCreate(['id' => $this->record_id], [
            'spanish'       => $this->spanish,
			'short_spanish' => $this->short_spanish,
            'english'       => $this->english,
            'short_english' => $this->short_english
		]);

        $this->create_button_label = __('Create') . ' ' . __('Status');
        $this->store_message(__('Status'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Status $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Status');
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
	public function destroy(Status $record) {
        $this->delete_record($record,__('Status') . ' ' . __('Deleted Successfully!!'));
    }
}
