<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $fillable =  [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'user_id'
    ];

    // Setters
    public function setNamehAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower($value));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] =  ucwords(strtolower($value));
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name) . ' ' .  ucwords($this->last_name);
    }



    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
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


    public function scopeName($query,$valor)
    {

        if ( trim($valor) != "") {
            $query->where('first_name','LIKE',"%$valor%")
                ->orwhere('last_name','LIKE',"%$valor%");
         }
    }

    public function scopeFirstName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('first_name',$valor);
         }
    }

    public function scopeLastName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('last_name',$valor);
         }
    }


    public function scopeGender($query,$gender){

        if ( trim($gender) != "") {
            $query->where('gender',$gender);
         }
    }

    public function scopeBirthDay($query,$birthday){
        $query->where('birthday',$birthday);
    }

    public function scopeBirthDayFromTo($query,$from,$to){
        $query->whereBetween('birthday',[$from,$to]);
    }
    public function scopeThisUserId($query,$user_id){
        $query->where('user_id',$user_id);
    }
}
