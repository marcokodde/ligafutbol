<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Teams extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name,$category_id;
    public $active = 1;
    public $categories;

    public function mount()
    {
        //$this->authorize('hasaccess', 'Teams.index');
        $this->manage_title = __('Manage') . ' ' . __('Teams');
        $this->search_label = "Team Name";
        $this->view_form = 'livewire.teams.form';
        $this->view_table = 'livewire.teams.table';
        $this->view_list  = 'livewire.teams.list';
        $this->categories = Category::Active()->orderBy('date_from')->get();
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Team')
                                                        : __('Create') . ' ' . __('Team');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Team::Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','category_id','active']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'         => 'required|min:3|max:50',
            'category_id'  => 'required|not_in:Elegir|not_in:Choose|exists:categories,id',
            'user_id'       => Auth::user()->id
		]);


		Team::updateOrCreate(['id' => $this->record_id], [
            'name'         => $this->name,
			'category_id'   => $this->category_id,
            'active'        => $this->active ? 1 : 0
		]);

        $this->create_button_label = __('Create') . ' ' . __('Team');
        $this->store_message(__('Team'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Team $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Team');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->name         = $record->name;
		$this->category_id  = $record->category_id;
        $this->active       = $record->active;
		$this->openModal();
	}

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Team $record) {
        $this->delete_record($record,__('Team') . ' ' . __('Deleted Successfully!!'));
    }
}
