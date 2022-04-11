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
        'user_id',
        'active'
    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }


    public function coaches(){
        return $this->belongsToMany(Team::class);
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function isActive(){
        return $this->active;
    }

    public function can_be_delete(){
       /*  if ($this->coaches()->count()) {
            return false;
        } */
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeUserId($query)
    {
        $query->where('user_id',Auth::user()->id);
    }

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

    public function scopeCategory($query,$valor)
    {
        if ( $valor) {
            $query->where('category_id',$valor);
         }
    }

    public function scopeActive($query)
    {
        $query->where('active',1);
    }

    public function isLinkedCoach($coach_id){
        return $this->coaches()->where('id',$coach_id);
    }
}