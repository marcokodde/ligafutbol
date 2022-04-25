<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Player;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Players extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $first_name,$last_name,$birthday,$gender;

    public function mount()
    {
        //$this->authorize('hasaccess', 'Playeres.index');
        $this->manage_title = __('Manage') . ' ' . __('Players');
        $this->search_label = __('Name');
        $this->view_form = 'livewire.players.form';
        $this->view_table = 'livewire.players.table';
        $this->view_list  = 'livewire.players.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Player')
                                                        : __('Create') . ' ' . __('Player');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Player::UserId()->Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['first_name','last_name','birthday','gender']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'first_name'=> 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'birthday'  => 'required',
            'gender'    => 'required|in:Female,Male',
		]);

 		Player::updateOrCreate(['id' => $this->record_id], [
            'first_name'=> $this->first_name,
			'last_name' => $this->last_name,
            'birthday'  => $this->birthday,
            'gender'    => $this->gender,
            'user_id'   => Auth::user()->id
		]);

        $this->create_button_label = __('Create') . ' ' . __('Player');
        $this->store_message(__('Player'));
	}

    /*+------------------------------+
	  | Lee Registro Editar o Borar  |
	 +-------------------------------+
    */

	public function edit(Player $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Player');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->first_name   = $record->first_name;
		$this->last_name    = $record->last_name;
        $this->birthday     = $record->birthday;
        $this->gender       = $record->gender;
		$this->openModal();
	}

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Player $record) {
        $this->delete_record($record,__('Player') . ' ' . __('Deleted Successfully!!'));
    }
}
