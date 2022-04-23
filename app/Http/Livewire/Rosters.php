<?php

namespace App\Http\Livewire;

use Carbon\Carbon;

use Livewire\Component;
use App\Models\Category;

use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\ZipcodeTrait;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Rosters extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use ZipcodeTrait;

    protected $listeners = ['destroy'];


    // Taba Equipos (Teams)
    public $name=null;
    public $category_id=null;
    public $zipcode=null;

    // Fechas mínimas y máximas según sexo del jugador
    public $female_birthday_from,$female_birthday_to;
    public $male_birthday_from,$male_birthday_to;

    // Categorías.
    public $categories=null;
    public $category=null;

    public $town_state;

    public $allow_add_players = false;



    public function mount()
    {
        //$this->authorize('hasaccess', 'categories.index');
        $this->manage_title = __('Manage') . ' ' . __('Rosters');
        $this->categories = Category::Active()->orderby('name')->get();
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        return view('livewire.rosters.rosters');
	}

    /*+---------------------------------------------+
      | Calcula las fechas de nacimiento límite     |
      +---------------------------------------------+
     */

    public function calculate_birthday_limits(){
        $this->reset(['category']);
        if($this->category_id){
            $this->category = Category::findOrFail($this->category_id);

            $date_category_from         = New Carbon($this->category->date_from);
            $this->female_birthday_from = $date_category_from->subYear();
            $this->female_birthday_to   = New Carbon($this->category->date_to);

            $this->male_birthday_from   = New Carbon($this->category->date_from);
            $date_category_from         = New Carbon($this->category->date_from);
            $this->male_birthday_to     = $date_category_from->addYears(3);

            $this->female_birthday_from = $this->female_birthday_from->format('Y-m-d');
            $this->female_birthday_to   = $this->female_birthday_to->format('Y-m-d');
            $this->male_birthday_from   = $this->male_birthday_from->format('Y-m-d');
            $this->male_birthday_to     = $this->male_birthday_to->format('Y-m-d');
        }

    }

}
