<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable =  [
        'name',
        'email',
        'address',
        'interior_number',
        'zipcode',
        'phone',
        'user_account_manager_id'
    ];


    // Setters
    public function setNameAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower($value));
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] =  strtolower($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] =  ucwords(strtolower($value));
    }

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function tasks(){
        return $this->hasMany(Task::class,'status_id');
    }


    public function account_manager(){
        return $this->belongsTo(User::class,'user_account_manager_id');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->tasks()->count()) return false;
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

    public function scopeZipcode($query,$valor)
    {
        if ($valor) {
            $query->where('zipcode',$valor);
         }
    }

    public function scopePhone($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('phone','LIKE',"%$valor%");
         }
    }


}


