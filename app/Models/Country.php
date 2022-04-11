<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Country extends Model
{
    use HasFactory;

    protected $fillable =  [
        'country',
        'code',
        'url',
        'isdefault',
        'include',
        'latinoamerica'
    ];



    /**+------------------------+
     * | Funciones de apoyo     |
     * +------------------------+
     */
    // ¿Puede ser borrado?
    public function can_be_delete(){
        return true;
    }

    /*+---------+
      | Listas  |
      +---------+
    */

    public function countries_payer_list(){
        return $this->wherehas('payers')->get();
    }
}
