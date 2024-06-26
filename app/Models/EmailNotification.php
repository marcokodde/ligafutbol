<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    use HasFactory;

    protected $table = 'email_notifications';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'email',
        'noty_create_user',
        'noty_payment',
        'noty_without_payment',
        'noty_register_teams',
        'noty_register_players'
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

}
