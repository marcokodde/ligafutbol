<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use App\Models\TeamCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\livewire\Traits\ZipcodeTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegisterPlayers extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use ZipcodeTrait;

    public $user;
    public $categories  = null;
    public $category    = null;
    public $category_id = null;

    public $teams   = null;
    public $team    = null;
    public $team_id = null;


    public $error_message   = null;
    public $finish          = false;


    /*+----------------------------------------------+
	  | Valida autenticidad y toma las categorías    |
	  +----------------------------------------------+
    */
    public function mount($token=null){

        if(Auth::user()){
            $this->user = Auth::user();
        }else{
            $this->user = User::TokenRegisterPlayers($token)->first();
            if($this->user){
                $this->read_categories_to_user();
            }
         }

    }

    /*+----------------------------------------------+
	  |         Presenta formulario                  |
	  +----------------------------------------------+
    */

    public function render() {
        return view('livewire.register_players.index');
    }


    /*+---------------------+
	  | Lee la Categorías   |
	  +---------------------+
    */

    public function read_categories_to_user(){
        $categories_user_ids = DB::table('team_categories')
                                ->select('category_id')
                                ->distinct('category_id')
                                ->where('user_id',$this->user->id)
                                ->get();
        $categoriesIds = array();

        foreach($categories_user_ids as $category_user_id){
            array_push($categoriesIds,$category_user_id->category_id);
        }
        $this->categories = Category::whereIn('id',$categoriesIds)->get();

    }

    /*+---------------------+
	  | Lee la Categoría    |
	  +---------------------+
    */

    public function read_category(){
        $this->reset(['category']);
        if($this->category_id){
            $this->category = Category::findOrFail($this->category_id);
            $this->teams    = Team::ThisUserId($this->user->id)
                                ->ByCategory($this->category_id)
                                ->get();
        }
    }


    /*+-------------+
	  | Lee Equipo  |
	  +-------------+
    */
    public function read_team(){
        $this->reset(['team']);
        if($this->team_id){
            $this->team = Team::findOrFail($this->team_id);
        }

    }



    public function review_data(){

        $this->validate_fill_arrays();
        if(!$this->error_message){
            $this->validate_not_duplicate_name_in_array();
        }

        if(!$this->error_message){
            $this->validate_zipcodes();
        }

        if(!$this->error_message){
            $this->validate_not_duplicate_name_in_database();
        }

        if(!$this->error_message){
            $this->create_teams();
        }

    }


    // Todos los datos llenos
    private function validate_fill_arrays(){
        for ($i=0;$i< count($this->categoriesIds);$i++) {
            $this->error_names[$i]      = isset($this->team_names[$i])   ? false : true;
            $this->error_zipcodes[$i]   = isset($this->team_zipcodes[$i]) ? false : true;
        }

        $this->error_message = null;
        for ($i=0;$i< count($this->categoriesIds);$i++) {
            if($this->error_names[$i] || $this->error_zipcodes[$i] ){
                $this->error_message = __('Please fill al input boxes');
            }
        }

    }

    /** Valida que no esté duplicado el nombre en la misma categoría  */
    private function validate_not_duplicate_name_in_array(){
        for ($i=0;$i < count($this->categoriesIds);$i++) {
            $this->error_names[$i] = false;
            for($j=$i+1;$j<count($this->categoriesIds)-1;$j++){
                if($this->team_names[$i] == $this->team_names[$j] && $this->categoriesIds[$i] == $this->categoriesIds[$j] ){
                    $this->error_message = __('There are duplicate name team');
                    $this->error_names[$i] = true;
                    break;
                }
                if($this->error_message) break;

            }
       }

    }

    /** Valida que los Zipcode Existan  */
    private function validate_zipcodes(){
        for ($i=0;$i < count($this->categoriesIds);$i++) {
            $this->error_zipcodes[$i] = false;
            $record_zipcode = $this->read_this_zipcode($this->team_zipcodes[$i]);
            if(!$record_zipcode){
                $this->error_zipcodes[$i] = true;
                $this->error_message = __('Zipcode does not Exists');
                break;
            }
       }

    }


    /** Valida que no existan en base de datos */
    private function validate_not_duplicate_name_in_database(){
        $indices = array();
        for ($i=0;$i < count($this->categoriesIds);$i++) {

            $indices[$i] = 'Buscar' . $this->team_names[$i] . ' Con la categoría ' . $this->categoriesIds[$i];
            $this->error_names[$i] = true;
            $record_team = Team::ByCategory($this->categoriesIds[$i])->Team($this->team_names[$i])->first();
            if( $record_team ){
                $this->error_names[$i] = true;
                $this->error_message = __('The team already exists in category');
                break;
            }
       }

    }

    /** Agrega los equipos */
    private function create_teams(){

        for ($i=0;$i < count($this->categoriesIds);$i++) {
            $record_team_category = TeamCategory::findOrFail($this->teamsCategoriesIds[$i]);

            Team::create([
                'name'          => $this->team_names[$i],
                'category_id'   => $this->categoriesIds[$i],
                'zipcode'       => $this->team_zipcodes[$i],
                'user_id'       => $this->user->id,
                'active'        => 1,
                'enabled'       => 1,
                'payment_id'    => $record_team_category->payment_id,
                'amount'        => round($record_team_category->payment->amount/$record_team_category->payment->source,2),
            ]);

            $record_team_category->update_registered_teams();

        }

        $this->error_message = null;
        $this->finish = true;
        $this->user->delete_token_to_register_teams();

        for ($i=0;$i < count($this->categoriesIds);$i++) {
            $this->error_names[$i]      = false;
            $this->error_zipcodes[$i]   = false;
        }


    }

}

