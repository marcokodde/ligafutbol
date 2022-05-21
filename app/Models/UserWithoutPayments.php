<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWithoutPayments extends Model
{
    use HasFactory;
    protected $table = 'users_without_payments';
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /*+-----------------------------+
      | Setters                     |
      +----------------------------+
    */
    public function setNamehAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower($value));
    }

    public function setEmaileAttribute($value)
    {
        $this->attributes['email'] =  strtolower(trim($value));
    }


    /*+-----------------------------+
      |Actualizar directamente      |
      +-----------------------------+
    */

    public function update_Name($value){
        $this->name = ucwords(strtolower($value));;
        $this->save();
    }

}
