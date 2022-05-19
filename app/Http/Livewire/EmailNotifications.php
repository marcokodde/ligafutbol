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
    public  $name
            ,$email
            ,$noty_create_user
            ,$noty_payment
            ,$noty_without_payment
            ,$noty_register_teams
            ,$noty_register_players;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Email Notifications');
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
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Email Notification')
                                                        : __('Create') . ' ' . __('Email Notification');


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
        $this->reset(['name','email'
                            ,'noty_create_user'
                            ,'noty_payment'
                            ,'noty_without_payment'
                            ,'noty_register_teams'
                            ,'noty_register_players']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'                  => 'required|min:3|max:50',
            'email'                 => 'required|email|max:50',
            'noty_create_user'      => 'nullable',
            'noty_payment'          => 'nullable',
            'noty_without_payment'  => 'nullable',
            'noty_register_teams'   => 'nullable',
            'noty_register_players' => 'nullable'
		]);


		EmailNotification::updateOrCreate(['id' => $this->record_id], [
            'name'                  => $this->name,
			'email'                 => $this->email,
            'noty_create_user'      => $this->noty_create_user,
            'noty_payment'          => $this->noty_payment,
            'noty_without_payment'  => $this->noty_without_payment,
            'noty_register_teams'   => $this->noty_register_teams,
            'noty_register_players' => $this->noty_register_players
		]);

        $this->create_button_label = __('Create') . ' ' . __('Email Notification');
        $this->store_message(__('Email Notification'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(EmailNotification $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Email Notification');
        $this->record                   = $record;
		$this->record_id                = $record->id;
		$this->name                     = $record->name;
		$this->email                    = $record->email;
        $this->noty_create_user         = $record->noty_create_user;
        $this->noty_payment             = $record->noty_payment;
        $this->noty_without_payment     = $record->noty_without_payment;
        $this->noty_register_teams      = $record->noty_register_teams;
        $this->noty_register_players    = $record->noty_register_players;
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
