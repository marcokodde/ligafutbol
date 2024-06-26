<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Categories extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $name, $date_from, $date_to, $gender, $active;
    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->authorize('hasaccess', 'categories.index');
        $this->manage_title = __('Manage') . ' ' . __('Category');
        $this->search_label = "Category Name";
        $this->view_form = 'livewire.categories.form';
        $this->view_table = 'livewire.categories.table';
        $this->view_list  = 'livewire.categories.list';
        $this->pagination = 12;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

    public function render()
    {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Category')
            : __('Create') . ' ' . __('Category');

        $searchTerm = '%' . $this->search . '%';

        return view('livewire.index', [
            'records' => Category::Name($searchTerm)->paginate($this->pagination),
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
        $this->reset(['name', 'date_from', 'date_to', 'gender', 'active']);
    }

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

    public function store()
    {

        $this->validate([
            'name'          => 'required|min:4|max:50|unique:categories,name,' . $this->record_id,
            'date_from'     => 'required',
            'date_to'       => 'required',
            'gender'        => 'required|in:Female,Male,Both',
        ]);

        Category::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->name,
            'date_from' => $this->date_from,
            'date_to'   => $this->date_to,
            'gender'    => $this->gender,
            'active'    => $this->active ? 1 : 0
        ]);

        $this->create_button_label = __('Create') . ' ' . __('Category');
        $this->store_message(__('Category'));
    }

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

    public function edit(Category $record)
    {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Category');
        $this->record       = $record;
        $this->record_id    = $record->id;
        $this->name         = $record->name;
        $this->date_from    = $record->date_from;
        $this->date_to      = $record->date_to;
        $this->gender       = $record->gender;
        $this->active       = $record->active;
        $this->openModal();
    }

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
    public function destroy(Category $record)
    {
        $this->delete_record($record, __('Category') . ' ' . __('Deleted Successfully!!'));
    }
}
