<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Player;
use App\Models\Team;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Livewire\Traits\ZipcodeTrait;
use App\Http\Livewire\Traits\SettingsTrait;
use Symfony\Component\HttpFoundation\Session\Session;
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
        $this->allow_create = false;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->allow_create = is_null($this->error_message) ? true : false;
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

        $record_team = $this->create_team();

        if($record_team){
            for($i=1;$i<=$this->general_settings->max_players_by_team;$i++){
                if(isset($this->first_names[$i])){
                    $record_player = $this->create_player($i);
                    $record_team->players()->attach($record_player);
                }
            }
        }
        $this->clear_all_data();
        session()->flash('message', __('The list has been registered'));
    }

    // Inicializa todos los dato excepto la categoría
    public function clear_all_data(){
        $this->reset([
            'name',
            'zipcode',
            'first_names',
            'last_names',
            'genders',
            'birthdays',
            'zipcode_exists',
            'town_state',
            'error_message'
        ]);
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
        return true;

    }

    // Datos para los jugadores
    private function validate_players(){
        for($i=1;$i<=$this->general_settings->max_players_by_team;$i++){
            if(!$this->validate_first_names($i)) break;      // Nombres
            if(!$this->validate_last_names($i)) break;       // Apellidos
            if(!$this->validate_genders($i)) break;          // Géneros
            if(!$this->validate_birthdays($i)) break;        // Fechas de Nacimiento
        }
        if($this->error_message) return false;
        return true;
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
        return true;
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
                return true;
            }
        }
        return false;

    }

        // Valida a partir de que traiga el nombre
    private function validate_last_names($i){
        if(count($this->last_names)){
            if(isset($this->last_names[$i])){
                // ¿Trae Apellido?
                    if(!isset($this->first_names[$i])){
                        $this->error_message = __('Incomplete name to') . ' ' . $this->last_names[$i];
                        return false;
                    }
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
                return true;

            }
        }
        return false;
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
                return true;
            }
        }
        return false;
    }
        // Valida a partir de Fecha de Nacimiento
    private function validate_birthdays($i){
        if(count($this->birthdays)){
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
                return true;
            }
            return false;
        }
        return false;
    }

    private function display_data($punto_validacion=''){
        dd( $punto_validacion,
            'Categoría=' . $this->category->name,
            'Equipo=' . $this->name,
            'Zipcode=' . $this->zipcode,
            'Ciudad=' . $this->town_state,
            'Nombres',$this->first_names,
            'Apellidos',$this->last_names,
            'Géneros',$this->genders,
            'Fechas de nacimiento',$this->birthdays);
    }

    // Crea Equipo
    private function create_team(){
        $this->record_id = null;
        return Team::updateOrCreate(['id' => $this->record_id], [
            'name'          => $this->name,
			'category_id'   => $this->category_id,
            'zipcode'       => $this->zipcode,
            'user_id'       => Auth::user()->id,
            'active'        => 1
		]);
    }

    // Crea Jugador
    private function create_player($i){
        $this->record_id = null;
        return Player::updateOrCreate(['id' => $this->record_id], [
            'first_name'=> $this->first_names[$i],
			'last_name' => $this->last_names[$i],
            'birthday'  => $this->birthdays[$i],
            'gender'    => $this->genders[$i],
            'user_id'   => Auth::user()->id
		]);
    }
}