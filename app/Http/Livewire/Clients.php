<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Clients extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $name=null;
    public $email=null;
    public $address=null;
    public $interior_number=null;
    public $zipcode=null;
    public $phone=null;
    public $user_account_manager_id=null;
    public $users;


    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Clients');
        $this->search_label = "Client Name";
        $this->view_form    = 'livewire.clients.form';
        $this->view_table   = 'livewire.clients.table';
        $this->view_list    = 'livewire.clients.list';
        $this->users        = User::orderby('name')->get();
        $this->pagination   = 8;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Client')
                                                        : __('Create') . ' ' . __('Client');

        $searchTerm = '%' . $this->search . '%';



        return view('livewire.index', [
            'records' => Client::Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset([
            'name',
            'email',
            'address',
            'interior_number',
            'zipcode',
            'phone',
            'user_account_manager_id'
        ]);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {
		$this->validate([
            'name'                      => 'required|min:3|max:50',
            'user_account_manager_id'   => 'required|not_in:Elegir|not_in:Choose|exists:users,id',
		]);

		Client::updateOrCreate(['id' => $this->record_id], [
            'name'  => $this->name,
            'email'                 => $this->email,
            'address'               => $this->address,
            'interior_number'       => $this->interior_number,
            'zipcode'               => $this->zipcode,
            'phone'                 => $this->phone,
            'user_account_manager_id'=> $this->user_account_manager_id,

		]);

        $this->create_button_label = __('Create') . ' ' . __('Client');
        $this->store_message(__('Client'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Client $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Client');
        $this->name             = $record->name;
        $this->email            = $record->email;
        $this->address          = $record->address;
        $this->interior_number  = $record->interior_number;
        $this->zipcode          = $record->zipcode;
        $this->phone            = $record->phone;
        $this->user_account_manager_id= $record->user_account_manager_id;

		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Client $record) {

        $this->delete_record($record,__('Client') . ' ' . __('Deleted Successfully!!'));
    }
}
