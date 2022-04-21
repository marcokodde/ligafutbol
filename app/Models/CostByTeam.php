<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostByTeam extends Model
{
    use HasFactory;
    protected $table = 'cost_by_teams';
    public $timestamps = false;
    protected $fillable =  [
        'min',
        'max',
        'cost'
    ];


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function can_be_delete(){
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */



}

