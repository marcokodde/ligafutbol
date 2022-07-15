<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'category_id',
        'zipcode',
        'user_id',
        'active',
        'enabled',
        'payment_id',
        'amount',

    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function zipcodex(){
        return $this->belongsTo(Zipcode::class,'zipcode','zipcode');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function coaches(){
        return $this->belongsToMany(Coach::class);
    }

    public function total_coaches(){
        return $this->belongsToMany(Coach::class)->count();
    }

    public function players(){
        return $this->belongsToMany(Player::class);
    }

    public function total_players(){
        return $this->belongsToMany(Player::class)->count();
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function isActive(){
        return $this->active;
    }

    public function can_be_delete(){
       if ($this->players()->count()) { return false;   }

        if ($this->payment()->count()) { return false;  }


        $team_category = TeamCategory::where('category_id',$this->category_id)
                    ->where('qty_teams','>','registered_teams')
                    ->where('user_id',Auth::user()->id)
                    ->whereNull('payment_id')
                    ->first();

        return $team_category;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeUserId($query)
    {
        $query->where('user_id', Auth::user()->id);
    }

    public function scopeThisUserId($query,$user_id){
        $query->where('user_id', $user_id);

    }

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

    public function scopeTeam($query,$valor)
    {
        $valor = trim($valor);
        if ( trim($valor) != "") {
            $query->where('name',$valor);
         }
    }

    public function scopeByCategory($query,$category_id)
    {
        if ( $category_id) {
            $query->where('category_id','=',$category_id);
         }
    }

    public function scopeActive($query)
    {
        $query->where('active',1);
    }

    public function isLinkedCoach($coach_id){
        return $this->belongsToMany(Coach::class)->where('coach_id',$coach_id)->count();
    }
}
