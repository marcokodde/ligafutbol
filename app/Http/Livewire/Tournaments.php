<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Tournament;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class Tournaments extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $english, $spanish, $short_spanish, $short_english, $description;
    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Tournaments');
        $this->search_label = __('Tournament') . ' ' . __('Name');
        $this->view_form = 'livewire.tournaments.form';
        $this->view_table = 'livewire.tournaments.table';
        $this->view_list  = 'livewire.tournaments.list';
        // Permisos
        $this->permission_create   = 'tournaments.create';
        $this->permission_edit     = 'tournaments.edit';
        $this->permission_delete   = 'tournaments.delete';
        $this->permission_view     = 'tournaments.view';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

    public function render()
    {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Tournaments')
            : __('Create') . ' ' . __('Tournaments');

        $searchTerm = '%' . $this->search . '%';


        if (App::isLocale('en')) {
            return view('livewire.index', [
                'records' => Tournament::English($searchTerm)->paginate($this->pagination),
            ]);
        }

        return view('livewire.index', [
            'records' => Tournament::Spanish($searchTerm)->paginate($this->pagination),
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
        $this->reset(['spanish', 'short_spanish', 'english', 'short_english', 'description']);
    }

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

    public function store()
    {
        $this->validate([
            'spanish'       => 'required|min:3|max:15|unique:tournaments,spanish,' . $this->record_id,
            'short_spanish' => 'required|min:3|max:5 |unique:tournaments,short_spanish,' . $this->record_id,
            'english'       => 'required|min:3|max:15|unique:tournaments,english,' . $this->record_id,
            'short_english' => 'required|min:3|max:5 |unique:tournaments,short_english,' . $this->record_id,
            'description'   => 'sometimes'
        ]);

        Tournament::updateOrCreate(['id' => $this->record_id], [
            'spanish'       => $this->spanish,
            'short_spanish' => $this->short_spanish,
            'english'       => $this->english,
            'short_english' => $this->short_english,
            'description' => $this->description

        ]);

        $this->create_button_label = __('Create') . ' ' . __('Tournament');
        $this->store_message(__('Tournaments'));
    }

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

    public function edit(Tournament $record)
    {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Tournament');
        $this->record = $record;
        $this->record_id = $record->id;
        $this->english = $record->english;
        $this->spanish = $record->spanish;
        $this->short_spanish = $record->short_spanish;
        $this->short_english = $record->short_english;
        $this->description = $record->description;
        $this->openModal();
    }

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
    public function destroy(tournaments $record)
    {

        $this->delete_record($record, __('Tournament') . ' ' . __('Deleted Successfully!!'));
    }
}
