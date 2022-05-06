<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
//use App\Http\livewire\Traits\ZipcodeTrait;
use App\Http\Livewire\Traits\SettingsTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegisterPlayers extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    //use ZipcodeTrait;
    use SettingsTrait;

    public $user;
    public $categories  = null;
    public $category    = null;
    public $category_id = null;

    public $teams   = null;
    public $team    = null;
    public $team_id = null;


    public $error_message   = null;
    public $finish          = false;

    protected $listeners = ['reload_players'];

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
         $this->readSettings();
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

        if($this->categories->count() == 1){
            foreach($this->categories as $category_read){
                $this->category_id = $category_read->id;
                $this->read_category();
            }

        }

    }

    /*+---------------------+
	  | Lee la Categoría    |
	  +---------------------+
    */

    public function read_category(){
        $this->reset(['category','teams','team_id']);
        if($this->category_id){
            $this->category = Category::findOrFail($this->category_id);
            $this->teams    = Team::ThisUserId($this->user->id)
                                ->ByCategory($this->category_id)
                                ->get();
            if($this->teams->count() == 1){
                foreach($this->teams as $team_read){
                    $this->team_id = $team_read->id;
                    $this->read_team();
                }
            }
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


    /*+--------------------+
	  | Recarga jugadores  |
	  +--------------------+
    */
    public function reload_players(){
        $this->team = Team::findOrFail($this->team->id);
        $this->team->load('players');
    }


}

