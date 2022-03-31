<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;
    protected $table = 'sub_tasks';
    protected $fillable =  [
        'task_id',
        'title',
        'description',
    ];

    public function Task(){
        return $this->belongsTo(Task::class);
    }



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
