<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promoter extends Model
{
    use HasFactory;

    protected $table = 'promoters';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'phone',
        'email',
        'code'
    ];


        // Setters
        public function setNamehAttribute($value)
        {
            $this->attributes['name'] =  ucwords(strtolower(trim($value)));
        }

        public function setEmailAttribute($value)
        {
            $this->attributes['email'] =  strtolower(trim($value));
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

    public function scopeName($query,$valor)
    {

        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

    public function scopeEmail($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('email','LIKE',"%$valor%");
         }
    }

    public function scopePhone($query,$valor)
    {

        if ( trim($valor) != "") {
            $query->where('phone','LIKE',"%$valor%");
         }
    }

    public function scopeCode($query,$valor)
    {

        if ( trim($valor) != "") {
            $query->where('code','LIKE',"%$valor%");
         }
    }

    public function scopeSearch($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%")
                ->orwhere('email','LIKE',"%$valor%")
                ->orwhere('phone','LIKE',"%$valor%");
         }
    }

}
