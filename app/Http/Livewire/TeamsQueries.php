<?php


namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use App\Models\TeamCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class TeamsQueries extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $type_query;
    public $categories;
    public $category_id;

    public function mount()
    {
        //$this->authorize('hasaccess', 'categories.index');
        $this->categories = Category::wherehas('teams_categories')->get();
        $this->manage_title = __('Equipment reserved by Category');
        $this->view_search  = 'livewire.teams_queries.search';
        $this->view_table = 'livewire.teams_queries.table';
        $this->view_list  = 'livewire.teams_queries.list';
        $this->allow_create = false;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {

        $records = TeamCategory::CategoryiD($this->category_id)->paginate($this->pagination);
        return view('livewire.index', [
            'records' => $records,
        ]);


	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','date_from','date_to','gender','active']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

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

	public function edit(Category $record) {
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
	public function destroy(Category $record) {
        $this->delete_record($record,__('Category') . ' ' . __('Deleted Successfully!!'));
    }
}
