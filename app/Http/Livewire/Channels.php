<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Channels extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $channel,$short;
    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Channel');
        $this->search_label = "Channel";
        $this->view_form = 'livewire.channels.form';
        $this->view_table = 'livewire.channels.table';
        $this->view_list  = 'livewire.channels.list';
        $this->pagination = 8;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Channel')
                                                        : __('Create') . ' ' . __('Channel');

        $searchTerm = '%' . $this->search . '%';

        return view('livewire.index', [
            'records' => Channel::Channel($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['channel','short']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {
		$this->validate([
            'channel'   => 'required|min:3|max:15|unique:channels,channel,' . $this->record_id,
            'Short'     => 'required|min:3|max:5 |unique:channels,short,' . $this->record_id,
		]);


		$priority = Channel::updateOrCreate(['id' => $this->record_id], [
            'channel'   => $this->channel,
			'short'     => $this->short,
		]);

        $this->create_button_label = __('Create') . ' ' . __('Channel');
        $this->store_message(__('Channel'));
	}


    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Channel $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Channel');
        $this->record= $record;
		$this->record_id    = $record->id;
		$this->channel      = $record->channel;
		$this->short        = $record->short;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Channel $record) {
        $this->delete_record($record,__('Channel') . ' ' . __('Deleted Successfully!!'));
    }
}

