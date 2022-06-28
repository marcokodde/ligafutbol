<?php


namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use App\Models\TeamCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class TotalTeamsByCategories extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $type_query, $show;
    public $category,$category_id,$categories;

    public function mount($show=null)
    {
        $this->categories = Category::wherehas('teams_categories')->get();
        $this->manage_title = __('Total Equipment Reserved By Category');
        $this->view_table = 'livewire.total_teams_by_categories.table';
        $this->view_list  = 'livewire.total_teams_by_categories.list';
        $this->allow_create = false;
        $this->view_search = null;
        $this->show = $show;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $records = TeamCategory::groupBy('category_id')->select('category_id')
        ->selectRaw('sum(qty_teams) as teams')
        ->selectRaw('sum(registered_teams) as reservations')
        ->paginate(20);
        if ($this->show == "acordeon") {
            return view('livewire.total_teams_by_categories.index', [
                'records' => $records,
            ]);
        } else {
            return view('livewire.index', [
                'records' => $records,
            ]);
        }
	}
}