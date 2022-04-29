<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;

use Livewire\Component;
use App\Models\Category;
use App\Models\TeamCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Livewire\Traits\ZipcodeTrait;
use App\Http\Livewire\Traits\SettingsTrait;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TeamCategories extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use ZipcodeTrait;
    use SettingsTrait;

    protected $listeners = ['destroy'];

    // Taba Equipos (Teams)
    public $name        = array();
    public $category_id = array();
    public $zipcode     = array();

    // Categorías.
    public $team_categories=null;
    public $category=null;

    public $town_state;
    public $values      = array();
    public $team_categoriesIds = array();
    public $i = 0;
    // Errores
    public $error_message   = null;
    public $error_team      = false;
    public $team_exists     = Null;


    public function mount()
    {
        //$this->authorize('hasaccess', 'categories.index');
        $this->manage_title = __('Manage') . ' ' . __('Team Categories');
        $this->readSettings();
        $this->user = User::latest('id')->first();

        $this->team_categories = TeamCategory::wherehas('category')->where('user_id', $this->user->id)->orderby('id')->get();
            foreach($this->team_categories as $team_category) {
                for ($i=1; $i<=$team_category->qty_teams; $i++) {
                    $this->categoryteamIds[$i] = $team_category->category->id;  
                    $this->team_categoriesIds[$i] = $team_category->qty_teams;
                    $this->name[$i] = 0;
                    $this->zipcode[$i] = 0;
                    $this->category_id[$i] = 0;
                }
            }
        $this->allow_create = false;
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->allow_create = is_null($this->error_message) ? true : false;
        return view('livewire.team-categories.index');
	}

    /*+---------------------------------------------+
      | Calcula las fechas de nacimiento límite     |
      +---------------------------------------------+
     */

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


    public function store(){
        $this->name = trim($this->name);
        $this->error_message = null;
        $this->reset(['error_message','error_team']);

        if(!$this->validate_team())     return false;

        $this->create_team();
        $this->clear_all_data();
        session()->flash('message', __('The Team has been registered'));
    }

    // Inicializa todos los dato excepto la categoría
    public function clear_all_data(){
        $this->reset([
            'name',
            'zipcode',
            'zipcode_exists',
            'town_state',
            'error_message'
        ]);
    }

    // Datos para el Equipo
    private function validate_team(){
        dd($this->category_id, $this->name, $this->zipcode);
        foreach($this->team_categories as $team_category) {
            for ($i=1; $i<=$team_category->qty_teams; $i++) {
                foreach ($this->name as $key => $value) {
                    dd($key, $value);
                    if(isset($nombre)) {
                        $this->error_message = __('Team Name is Required');
                        $this->error_team = true;
                        return false;
                    }
                }

                $team_exists = Team::UserId()->Team($this->name[$i])->Category($this->category_id[$i])->first();
                if($team_exists){
                    $this->error_message = __('The team already exists');
                    $this->error_team = true;
                    return false;
                }

                if(!$this->zipcode[$i] || strlen($this->zipcode[$i]) == 0){
                    $this->error_message = __('Zipcode is Required');
                    $this->error_team = true;
                    return false;
                }

                if(!$this->zipcode_exists){
                    $this->error_message = __('Zipcode does not Exists');
                    $this->error_team = true;
                    return false;
                }
                return true;
            }
        }
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

      

    private function display_data($punto_validacion=''){
        dd( $punto_validacion,
            'Categoría=' .  $this->category->name,
            'Equipo=' .     $this->name,
            'Zipcode=' .    $this->zipcode,
            'Ciudad=' . $this->town_state,
        );
    }

    // Crea Equipo
    public function create_team(){
        if(!$this->validate_team()) return false;
        foreach($this->team_categories as $team_category) {
            for ($i=1; $i<=$team_category->qty_teams; $i++) {
                return Team::Create([
                    'name'          => $this->name[$i],
                    'category_id'   => $this->category_id[$i],
                    'zipcode'       => $this->zipcode[$i],
                    'user_id'       => $this->user->id,
                    'active'        => 1
                ]);
            }
        }
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