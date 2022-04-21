<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use App\Models\CostByTeam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class CostsByTeam extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $min,$max,$cost;
    protected $listeners = ['destroy'];

    public function mount(){
        $this->authorize('hasaccess', 'costsbyteam.index');
        $this->manage_title = __('Manage') . ' ' . __('Costs By Team');
        $this->search_label = Null;
        $this->view_search = Null;
        $this->view_form    = 'livewire.costsbyteam.form';
        $this->view_table   = 'livewire.costsbyteam.table';
        $this->view_list    = 'livewire.costsbyteam.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Cost')
                                                        : __('Create') . ' ' . __('Cost');

        return view('livewire.index', [
            'records' => CostByTeam::paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['max','min','cost']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

        $this->validate([
            'min'   => 'required|min:1|max:99|unique:cost_by_teams,min,' . $this->record_id,
            'max'   => 'required|min:1|max:99|unique:cost_by_teams,max,' . $this->record_id,
            'cost'  => 'required|integer'
		]);

		CostByTeam::updateOrCreate(['id' => $this->record_id], [
            'min'   => $this->min,
			'max'   => $this->max,
            'cost'  => $this->cost,
		]);

        $this->create_button_label = __('Create') . ' ' . __('Cost');
        $this->store_message(__('Cost'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(CostByTeam $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Category');
        $this->record   = $record;
		$this->record_id= $record->id;
		$this->min      = $record->min;
		$this->max      = $record->max;
        $this->cost     = $record->cost;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(CostByTeam $record) {
        $this->delete_record($record,__('Cost') . ' ' . __('Deleted Successfully!!'));
    }
}



