<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Priority;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class Priorities extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $english,$spanish,$short_spanish,$short_english,$priority;

    protected $listeners = ['destroy'];
    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Priority');
        $this->search_label = "Priority";
        $this->view_form = 'livewire.priorities.form';
        $this->view_table = 'livewire.priorities.table';
        $this->view_list  = 'livewire.priorities.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Priority')
                                                        : __('Create') . ' ' . __('Priority');

        $searchTerm = '%' . $this->search . '%';


        if(App::isLocale('en')){
            return view('livewire.index', [
                'records' => Priority::English($searchTerm)->orderby('priority')->paginate($this->pagination),
            ]);
        }

        return view('livewire.index', [
            'records' => Priority::Spanish($searchTerm)->orderby('priority')->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['spanish','short_spanish','english','short_english','priority']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {
		$this->validate([
            'spanish'       => 'required|min:3|max:15|unique:priorities,spanish,' . $this->record_id,
            'short_spanish' => 'required|min:3|max:5 |unique:priorities,short_spanish,' . $this->record_id,
            'english'       => 'required|min:3|max:15|unique:priorities,english,' . $this->record_id,
            'short_english' => 'required|min:3|max:5 |unique:priorities,short_english,' . $this->record_id,
            'priority'      => 'required'
		]);


		$priority = Priority::updateOrCreate(['id' => $this->record_id], [
            'spanish'       => $this->spanish,
			'short_spanish' => $this->short_spanish,
            'english'       => $this->english,
            'short_english' => $this->short_english,
            'priority'      => $this->priority
		]);


        $this->update_new_priorities($priority);

        $this->create_button_label = __('Create') . ' ' . __('Priority');
        $this->store_message(__('Priority'));
	}

    /*+-----------------------------------------------------+
      | Reasignar prioridad a los registros                 |
      +-----------------------------------------------------+
      | 1) Los registros antes de la prioridad indicada     |
      | 2) Los registros después de la prioridad indicada   |
      +-----------------------------------------------------+
     */

    private function update_new_priorities(Priority $priority){
        $priorities_to_update = Priority::orderby('priority')->get();

        $new_priority=0;
        foreach($priorities_to_update as $priority_to_update){
            $new_priority++;
            if($priority_to_update->id != $priority->id){
                $priority_to_update->priority = $new_priority;
                $priority_to_update->save();
            }

        }


    }

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Priority $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Priority');
        $this->record= $record;
		$this->record_id        = $record->id;
		$this->english          = $record->english;
		$this->spanish          = $record->spanish;
        $this->short_spanish    = $record->short_spanish;
        $this->short_english    = $record->short_english;
        $this->priority         = $record->priority;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Priority $record) {
        $this->delete_record($record,__('Priority') . ' ' . __('Deleted Successfully!!'));
    }
}
