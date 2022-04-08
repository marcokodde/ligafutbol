<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'category_id',
        'active'
    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

        public function category(){
            return $this->belongsTo(Category::class,'category_id');
        }



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

    public function scopeCattegory($query,$valor)
    {
        if ( $valor) {
            $query->where('category_id',$valor);
         }
    }

    public function scopeActive($query)
    {
        $query->where('active',1);
    }


}

