<?php

namespace App\Http\Livewire;

use Carbon\Carbon;

use App\Models\Team;
use Livewire\Component;

use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\Traits\CrudTrait;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Livewire\Traits\ZipcodeTrait;
use App\Http\Livewire\Traits\SettingsTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Rosters extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use ZipcodeTrait;
    use SettingsTrait;


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

    // Arreglos para campos
    public $first_names = array();
    public $last_names  = array();
    public $genders     = array();
    public $birthdays   = array();
    public $min_birthday= array();
    public $max_birthdat= array();

    // Errores
    public $error_message   = null;
    public $error_team      = false;
    public $team_exists     = Null;


    public function mount()
    {
        //$this->authorize('hasaccess', 'categories.index');
        $this->manage_title = __('Manage') . ' ' . __('Rosters');
        $this->readSettings();
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

     /*+---------------------------------------------+
      | Calcula fechas mínimo y máximo para fecha    |
      +---------------------------------------------+
     */

    public function calculate_limits_to_birthday(){

        if(count($this->genders)){
            for($i=1;$this->general_settings->max_players_by_team;$i++){
                if(isset($this->gender[$i])){
                    dd('$i=' . $i ,'  es= ' . $this->genders[$i]);

                }

            }
        }
    }

     /*+----------------------------------------+
      | Almacena Datos del Roster               |
      +-----------------------------------------+
      | 1) Equipo                               |
      |     (a) Datos requeridos                |
      |         * Nombre                        |
      |         * Zipcode                       |
      |    (b) Existencia de datos             |
      |         * Equipo no exista en categoría |
      |         * Zona potal exista             |
      |     (c) Grabar datos                    |
      | 2) Jugadores                            |
      |     (a) Datos requeridos                |
      |     (b) Si existe jugador               |
      |     (c) Grabar                          |
      +-----------------------------------------+
     */
    public function store(){
        $this->name = trim($this->name);
        $this->error_message = null;
        $this->reset(['error_message','error_team']);

        if(!$this->validate_team())     return false;
        if(!$this->validate_avoid_all_data())return false;
        if(!$this->validate_players()) return false;

        dd('Pasó validaciones, ahora hay que agregar los registros');

    }

    // Datos para el Equipo
    private function validate_team(){
        if(!$this->name || strlen(trim($this->name)) == 0  ){
            $this->error_message = __('Team Name is Required');
            $this->error_team = true;
            return false;
        }

        $team_exists = Team::UserId()->Team($this->name)->Category($this->category_id)->first();
        if($team_exists){
            $this->error_message = __('The team already exists');
            $this->error_team = true;
            return false;
        }

        if(!$this->zipcode || strlen($this->zipcode) == 0){
            $this->error_message = __('Zipcode is Required');
            $this->error_team = true;
            return false;
        }

        if(! $this->zipcode_exists){
            $this->error_message = __('Zipcode does not Exists');
            $this->error_team = true;
            return false;
        }


    }

    // Datos para los jugadores
    private function validate_players(){
        for($i=1;$this->general_settings->max_players_by_team;$i++){
            if(!$this->validate_first_names($i)) return false;      // Nombres
            if(!$this->validate_last_names($i)) return false;       // Apellidos
            if(!$this->validate_genders($i)) return false;          // Géneros
            if(!$this->validate_birthdays($i)) return false;        // Fechas de Nacimiento
            return true;
        }
    }


    // ¿Hay algún dato o todo está vacío?
    private function validate_avoid_all_data(){

        // No hay ningún dato
        if(!count($this->first_names)){
            $this->error_message = __('No Players Names');
            return false;
        }

        if(!count($this->last_names)){
            $this->error_message = __('No Players Last Names');
            return false;
        }


        if(!count($this->genders)){
            $this->error_message = __('No Players Genders');
            return false;
        }


        if(!count($this->birthdays)){
            $this->error_message = __('No Players Birthdays');
            return false;
        }
    }

    // Valida a partir de que traiga el nombre
    private function validate_first_names($i){
        if(count($this->first_names)){
            if(isset($this->first_names[$i])){
                // ¿Trae Apellido?
                //if(count($this->last_names)){
                    if(!isset($this->last_names[$i])){
                        $this->error_message = __('Incomplete name to') . ' ' . $this->first_names[$i];
                        return false;
                    }
               // }

                // ¿Trae Género?
                if(!isset($this->genders[$i])){
                    $this->error_message = __('Missing gender for to') . ' ' . $this->first_names[$i] . ' ' . $this->last_names[$i];
                    return false;
                }
                // Fecha de nacimiento
                if(!isset($this->birthdays[$i])){
                    $this->error_message = __('Missing birthday for to') . ' ' . $this->first_names[$i] . ' ' . $this->last_names[$i];
                    return false;
                }

            }
        }
    }

        // Valida a partir de que traiga el nombre
    private function validate_last_names($i){
        if(count($this->last_names)){
            if(isset($this->last_names[$i])){
                // ¿Trae Apellido?
                //if(count($this->last_names)){
                    if(!isset($this->first_names[$i])){
                        $this->error_message = __('Incomplete name to') . ' ' . $this->last_names[$i];
                        return false;
                    }
                // }

                // ¿Trae Género?
                if(!isset($this->genders[$i])){
                    $this->error_message = __('Missing gender for to') . ' ' . $this->first_names[$i] . ' ' . $this->last_names[$i];
                    return false;
                }
                // Fecha de nacimiento
                if(!isset($this->birthdays[$i])){
                    $this->error_message = __('Missing birthday for to') . ' ' . $this->first_names[$i] . ' ' . $this->last_names[$i];
                    return false;
                }

            }
        }
    }

     // Valida a partir de que traiga el género
     private function validate_genders($i){
         if (count($this->genders)) {
             if (isset($this->genders[$i])) {
                 // ¿Trae Nombre?
                 if (!isset($this->first_names[$i])) {
                     $this->error_message = __('Incomplete name to') . ' ' . $this->first_names[$i];
                     return false;
                 }
                 // ¿Trae Apellido?
                 if (!isset($this->last_names[$i])) {
                     $this->error_message = __('Incomplete name to') . ' ' . $this->first_names[$i];
                     return false;
                 }

                 // Fecha de nacimiento
                 if (!isset($this->birthdays[$i])) {
                     $this->error_message = __('Missing birthday for to') . ' ' . $this->first_names[$i] . ' ' . $this->last_names[$i];
                     return false;
                 }
             }
         }
     }
        // Valida a partir de Fecha de Nacimiento
    private function validate_birthdays($i){
        if(count($this->genders)){
            if(isset($this->birthdays[$i])){
                // ¿Trae Nombre?
                if(!isset($this->first_names[$i])){
                    $this->error_message = __('Incomplete name to') . ' ' . $this->first_names[$i];
                    return false;
                }
                // ¿Trae Apellido?
                if(!isset($this->last_names[$i])){
                        $this->error_message = __('Incomplete name to') . ' ' . $this->first_names[$i];
                        return false;
                    }

                // Fecha de nacimiento
                if(!isset($this->genders[$i])){
                    $this->error_message = __('Missing gender for to') . ' ' . $this->first_names[$i] . ' ' . $this->last_names[$i];
                    return false;
                }
            }
        }

    }


}
