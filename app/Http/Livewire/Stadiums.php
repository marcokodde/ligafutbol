<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Stadium;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Stadiums extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $name, $place, $location, $active;
    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->authorize('hasaccess', 'stadiums.index');
        $this->manage_title = __('Manage') . ' ' . __('Stadiums');
        $this->search_label = "Stadium Name";
        $this->view_form = 'livewire.stadiums.form';
        $this->view_table = 'livewire.stadiums.table';
        $this->view_list  = 'livewire.stadiums.list';
        $this->pagination = 12;
    }

    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

    public function render()
    {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Stadium')
            : __('Create') . ' ' . __('Stadium');

        $searchTerm = '%' . $this->search . '%';

        return view('livewire.index', [
            'records' => Stadium::Name($searchTerm)->paginate($this->pagination),
        ]);
    }

    /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

    private function resetInputFields()
    {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name', 'place', 'location', 'active']);
    }

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

    public function store()
    {

        $this->validate([
            'name'      => 'required|min:4|max:50|unique:stadiums,name,' . $this->record_id,
            'place'     => 'required',
            'location'  => 'required',
        ]);

        Stadium::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->name,
            'place'     => $this->place,
            'location'  => $this->location,
            'active'    => $this->active ? 1 : 0
        ]);

        $this->create_button_label = __('Create') . ' ' . __('Stadium');
        $this->store_message(__('Stadium'));
    }

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

    public function edit(Stadium $record)
    {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Stadium');
        $this->record       = $record;
        $this->record_id    = $record->id;
        $this->name         = $record->name;
        $this->place        = $record->place;
        $this->location     = $record->location;
        $this->active       = $record->active;
        $this->openModal();
    }

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
    public function destroy(Stadium $record)
    {
        $this->delete_record($record, __('Stadium') . ' ' . __('Deleted Successfully!!'));
    }
}
