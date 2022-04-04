<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;
    protected $table = 'task_types';
    public $timestamps = false;
    protected $fillable =  [
        'english',
        'short_english',
        'spanish',
        'short_spanish'
    ];

    // Setters
    public function setSpanishAttribute($value)
    {
        $this->attributes['spanish'] =  ucwords(strtolower($value));
    }

    public function setEnglishAttribute($value)
    {
        $this->attributes['english'] =  ucwords(strtolower($value));
    }

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function tasks(){
        return $this->hasMany(Task::class,'type_task_id');
    }



    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->tasks()->count()) return false;
        if($this->subtasks()->count()) return false;
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeTaskType($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('spanish','LIKE',"%$valor%")
                  ->orwhere('english','LIKE',"%$valor%")
                  ->orwhere('short_spanish','LIKE',"%$valor%")
                  ->orwhere('short_english','LIKE',"%$valor%");
         }
    }

    public function scopeSpanish($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('spanish','LIKE',"%$valor%")
                  ->orwhere('short_english','LIKE',"%$valor%");
         }
    }
    public function scopeEnglish($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('english','LIKE',"%$valor%")
                  ->orwhere('short_spanish','LIKE',"%$valor%");
         }
    }

}


