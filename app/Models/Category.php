<?php

namespace App\Models;

use Carbon\Carbon;
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
        'active',
    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

        public function teams(){
            return $this->hasMany(Team::class);
        }

        public function payment(){
            return $this->belongsTo(Payment::class,'payment_id');
        }

         // TeamCategory -> que le pertenecen al usuario
         public function teams_categories() {
            return $this->hasMany(TeamCategory::class,'category_id');
        }
    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function isActive(){
        return $this->active;
    }

    public function can_be_delete(){
        if($this->teams()->count()) return false;
        return true;
    }

    public function birthday_limits($gender,$limit){
        $date_from  = New Carbon($this->date_from);
        $date_to    = New Carbon($this->date_to);

        if($gender == 'Female'){
            $date_from = $date_from->subYear();
            return $limit == 'from'  ? $date_from->format('Y-m-d')
                                    : $date_to->format('Y-m-d');
        }

        $date_to = $date_from->addYears(3)->subday();
        $date_from = New Carbon($this->date_from);

        return $limit == 'from' ? $date_from->format('Y-m-d')
                                : $date_to->format('Y-m-d');

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

