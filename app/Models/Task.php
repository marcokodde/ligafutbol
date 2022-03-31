<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable =  [
        'group_id',
        'title',
        'description',
    ];

    /*+--------------+
      | Relaciones   |
      +--------------+
     */



    public function subtasks(){
        return $this->hasMany(SubTask::class);
    }


    public function Group(){
        return $this->belongsTo(Group::class);
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->subtasks()->count()) return false;
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
