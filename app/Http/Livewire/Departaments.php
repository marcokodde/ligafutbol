<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Departament;
use App\Models\Position;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class Departaments extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $english,$spanish,$short_spanish,$short_english;

    protected $listeners = ['destroy'];
    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Departaments');
        $this->search_label = "Departament Name";
        $this->view_form = 'livewire.departaments.form';
        $this->view_table = 'livewire.departaments.table';
        $this->view_list  = 'livewire.departaments.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Departament')
                                                        : __('Create') . ' ' . __('Departament');

        $searchTerm = '%' . $this->search . '%';

        if(App::isLocale('en')){
            return view('livewire.index', [
                'records' => Departament::English($searchTerm)->paginate($this->pagination),
            ]);
        }
        return view('livewire.index', [
            'records' => Departament::Spanish($searchTerm)->paginate($this->pagination),
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
            'spanish'       => 'required|min:3|max:50|unique:statuses,spanish,' . $this->record_id,
            'short_spanish' => 'required|min:3|max:6 |unique:statuses,short_spanish,' . $this->record_id,
            'english'       => 'required|min:3|max:50|unique:statuses,english,' . $this->record_id,
            'short_english' => 'required|min:3|max:6 |unique:statuses,short_english,' . $this->record_id,
		]);


		Departament::updateOrCreate(['id' => $this->record_id], [
            'spanish'       => $this->spanish,
			'short_spanish' => $this->short_spanish,
            'english'       => $this->english,
            'short_english' => $this->short_english
		]);

        $this->create_button_label = __('Create') . ' ' . __('Departament');
        $this->store_message(__('Departament'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Departament $record) {
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
	public function destroy(Departament $record) {
        $this->delete_record($record,__('Departament') . ' ' . __('Deleted Successfully!!'));
    }
}

