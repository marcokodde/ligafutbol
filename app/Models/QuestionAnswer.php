<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
		    'answer',
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
    public function scopeQuestion($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('question','LIKE',"%$valor%");
        }
    }
}
