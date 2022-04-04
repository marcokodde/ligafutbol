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
        'user_require_id',
        'user_responsible_id',
        'priority_id',
        'deadline',
        'title',
        'description',
        'status_id'
    ];


    public function Task(){
        return $this->belongsTo(Task::class);
    }

    public function priority(){
        return $this->belongsTo(Priority::class,'priority_id');
    }

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function user_requiere(){
        return $this->belongsTo(User::class,'user_require_id');
    }

    public function user_responsible(){
        return $this->belongsTo(User::class,'user_responsible_id');
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
