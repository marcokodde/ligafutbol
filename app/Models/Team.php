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
        'payment_id',
        'amount',
        'enabled'
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

    public function zipcode() {
        return $this->belongsTo('App\Models\Zipcode', 'zipcode', 'zipcode');
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
        return $this->belongsTo(payment::class,'payment_id');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function isActive(){
        return $this->active;
    }

    public function can_be_delete(){
       /*  if ($this->coaches()->count()) {
            return false;
        } */
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeUserId($query)
    {
        $query->where('user_id', Auth::user()->id);
    }

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

    public function scopeCategory($query,$valor)
    {
        if ( $valor) {
            $query->where('category_id',$valor);
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
