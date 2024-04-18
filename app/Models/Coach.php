<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Coach extends Model
{
    use HasFactory;
    protected $table = 'coaches';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'phone',
        'user_id'
    ];

    // Setters
    public function setNamehAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower($value));
    }


    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function teams(){
        return $this->belongsToMany('App\Models\Team');
    }



    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->teams()->count()) return false;
        return true;
    }

    public function isLinkedTeam($team_id){
        return $this->belongsToMany(Team::class)->where('team_id', $team_id)->count();
    }
    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */
    public function scopeUserId($query)
    {
        $query->where('user_id',Auth::user()->id);
    }


    public function scopeSearch($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%")
                ->orwhere('phone','LIKE',"%$valor%");
         }
    }

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
        }
    }

    public function scopePhone($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('phone','LIKE',"%$valor%");
        }
    }


}
