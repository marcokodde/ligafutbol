<?php


namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use App\Models\TeamCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class TeamsQueries extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $type_query;
    public $category,$category_id,$categories;

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

    /** Lee la categoría */
    public function read_category(){
        $this->category = null;
        if($this->category_id){
            $this->category = Category::findOrFail($this->category_id);
        }
    }

}
