<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referee extends Model
{
    use HasFactory;
    protected $table = 'referees';
    protected $fillable =  [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'phone',
        'user_id'
    ];

    // Setters
    public function setNamehAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower(trim($value)));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] =  ucwords(strtolower(trim($value)));
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name) . ' ' .  ucwords($this->last_name);
    }



    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete()
    {
        return true;
    }

    public function isLinkedTeam($team_id)
    {
        return $this->belongsToMany(Team::class)->where('team_id', $team_id)->count();
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */


    // Nombre Completo
    public function scopeFullName($query, $valor)
    {
        if (trim($valor) != "") {
            $valor = str_replace(' ', '%', $valor);
            $query->where(DB::raw("CONCAT(first_name,last_name)"), 'LIKE', "%$valor%");
        }
    }

    public function scopeName($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('first_name', 'LIKE', "%$valor%")
                ->orwhere('last_name', 'LIKE', "%$valor%");
        }
    }

    public function scopeFirstName($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('first_name', $valor);
        }
    }

    public function scopeLastName($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('last_name', $valor);
        }
    }


    public function scopeGender($query, $gender)
    {

        if (trim($gender) != "") {
            $query->where('gender', $gender);
        }
    }

    public function scopeBirthDay($query, $birthday)
    {
        $query->where('birthday', $birthday);
    }

    public function scopeBirthDayFromTo($query, $from, $to)
    {
        $query->whereBetween('birthday', [$from, $to]);
    }
}
