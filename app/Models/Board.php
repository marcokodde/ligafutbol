<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $table = 'boards';
    protected $fillable =  [
        'title',
        'description',
    ];

    public function groups(){
        return $this->hasMany(Group::class);
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->groups()->count()) return false;
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeTitle($query,$valor){
        if ( trim($valor) != "") {
            $query->where('title','LIKE',"%$valor%");
         }
    }

    public function scopeDescription($query,$valor){
        if ( trim($valor) != "") {
            $query->where('description','LIKE',"%$valor%");
         }
    }

}
