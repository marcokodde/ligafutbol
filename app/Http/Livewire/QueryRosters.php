<?php

namespace App\Http\Livewire;

use App\Models\User;

use App\Models\Player;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Category;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QueryRosters extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;


    public $categories,$category_id;
    public $teams=null,$team_id=null;
    public $type = 'player';

    public function mount(){
        //$this->authorize('hasaccess', 'Playeres.index');
        $this->manage_title = __('Query') . ' ' . __('Rosters');
        $this->search_label = __('Name');
        $this->view_form = null;
        $this->view_search  = 'livewire.queries.rosters.search';
        $this->view_table   = 'livewire.queries.rosters.table';

        $this->categories   = Category::wherehas('players')->orderby('name')->get();
        $this->allow_create = false;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->view_list    = 'livewire.queries.rosters.list';

        if ($this->team_id) {
            $this->team = Team::findOrFail($this->team_id);
            return view('livewire.index', [
                'records' =>$this->team->players()->orderby('first_name')->paginate($this->pagination)
            ]);
        }

        if($this->category_id){
            $this->category = Category::findOrFail($this->category_id);
            $this->teams    = $this->category->teams()->wherehas('players')->orderby('name')->get();
            $this->view_list  = 'livewire.queries.rosters.list_by_category';

            return view('livewire.index', [
                'records' => $this->category->players()->paginate($this->pagination)
              ]);
        }

        return view('livewire.index', [
            'records' =>Player::wherehas('teams')->orderby('first_name')->paginate($this->pagination)
        ]);


	}

    // Llena equipos al cambiar la categoría
    public function read_teams(){
        $this->teams = null;
        if($this->category_id){
            $category = Category::findOrFail($this->category_id);
            $this->teams = Team::wherehas('players')->where('category_id',$this->category_id)->get();
           // $this->teams = $category->teams()->orderby('name')->get();
        }

    }

}

