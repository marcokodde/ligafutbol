<?php

namespace App\Http\Livewire;

use App\Models\Team;

use App\Models\Zipcode;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Teams extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name,$category_id,$zipcode;
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
            'records' => Team::UserId()->Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+----------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','category_id','zipcode','active']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'          => 'required|min:3|max:50',
            'category_id'   => 'required|not_in:Elegir|not_in:Choose|exists:categories,id',
            'zipcode'       => 'required|min:3|max:5|exists:zipcodes,zipcode',
		]);


		Team::updateOrCreate(['id' => $this->record_id], [
            'name'         => $this->name,
			'category_id'   => $this->category_id,
            'zipcode'       => $this->zipcode,
            'user_id'       => Auth::user()->id,
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
		$this->zipcode      = $record->zipcode;
        $this->active       = $record->active;
        $this->town_state   = $record->zipcodex->town . ',' . $record->zipcodex->state;

		$this->openModal();
	}

    /*+----------------------------+
	  | Elimina Registro             |
	  +------------------------------+
    */
	public function destroy(Team $record) {
        $this->delete_record($record,__('Team') . ' ' . __('Deleted Successfully!!'));
    }

    /*+---------------------+
	  | Lee Zonta Postal    |
	  +---------------------+
    */

    public function read_zipcode() {

        $this->town_state =Null;
        if ($this->zipcode) {
            $zipcode = Zipcode::Zipcode($this->zipcode)->first();
            if ($zipcode) {
                $this->town_state = $zipcode->town . ',' . $zipcode->state;
            } else {
                $this->town_state = __('Zipcode does not Exists');
            }
        }
    }
}
