<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\EmailNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class EmailNotifications extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name,$email;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('EmailNotifications');
        $this->search_label = __('Name');
        $this->view_form = 'livewire.email_notifications.form';
        $this->view_table = 'livewire.email_notifications.table';
        $this->view_list  = 'livewire.email_notifications.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('EmailNotification')
                                                        : __('Create') . ' ' . __('EmailNotification');


        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => EmailNotification::Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','email']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'         => 'required|min:3|max:50',
            'email'         => 'required|email|max:50'
		]);


		EmailNotification::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->name,
			'email'     => $this->email,
		]);

        $this->create_button_label = __('Create') . ' ' . __('EmailNotification');
        $this->store_message(__('EmailNotification'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(EmailNotification $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('EmailNotification');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->name         = $record->name;
		$this->email        = $record->email;
		$this->openModal();
	}

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(EmailNotification $record) {
        $this->delete_record($record,__('EmailNotification') . ' ' . __('Deleted Successfully!!'));
    }
}
