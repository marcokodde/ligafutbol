<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stadium extends Model
{
    use HasFactory;
    protected $table = 'stadiums';
    protected $fillable =  [
        'name',
        'place',
        'location',
        'active',
    ];

    // Setters
    public function setNamehAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower(trim($value)));
    }

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */
    public function isActive()
    {
        return $this->active;
    }

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

    public function scopeName($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('name', 'LIKE', "%$valor%");
        }
    }

    public function scopePlace($query, $gender)
    {

        if (trim($gender) != "") {
            $query->where('place', $gender);
        }
    }

    public function scopeLocation($query, $birthday)
    {
        $query->where('location', $birthday);
    }
}
