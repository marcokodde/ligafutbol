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
        'user_require_id',
        'user_responsible_id',
        'status_id',
        'type_task_id',
        'priority_id',
        'deadline',
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

    public function user_requiere(){
        return $this->belongsTo(User::class,'user_require_id');
    }

    public function user_responsible(){
        return $this->belongsTo(User::class,'user_responsible_id');
    }

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function task_type(){
        return $this->belongsTo(TaskType::class,'type_task_id');
    }

    public function priority(){
        return $this->belongsTo(Priority::class,'priority_id');
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
