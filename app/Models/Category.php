<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'date_from',
        'date_to',
        'gender',
        'active'
    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */





    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function isActive(){
        return $this->active;
    }

    public function can_be_delete(){
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

    public function scopeActive($query)
    {
        $query->where('active',1);
    }


}

