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

    //country_identification
    //customers
    public function customers(){
        return $this->hasMany('App\Models\Customer', 'country_id', 'id');
    }
    // fees
    public function fees(){
        return $this->hasMany('App\Models\fee', 'country_id', 'id');
    }
    // payers
    public function payers(){
        return $this->hasMany('App\Models\Payer', 'country_id', 'id')->orderby('payer');
    }

    //receivers
    public function receivers(){
        return $this->hasMany('App\Models\Receiver', 'country_id', 'id');
    }


    // Empresas: Company_Country
    public function companies() {
		return $this->belongsToMany('App\Models\Company');
    }

    // ¿Está ligado a la empresa del usuario?

    public function isLinkedToCompany(){
        return $this->belongsToMany('App\Models\Company')
                ->where('company_id',Auth::user()->companies->first()->id)->count();
    }

    // Credenciales x País
     public function identifications() {
		return $this->belongsToMany('App\Models\Identification');
    }

    public function transfers()
    {
        return $this->hasManyThrough(Transfer::class, Receiver::class,'country_id','receiver_id','id','id');
    }


    /**+------------------------+
     * | Funciones de apoyo     |
     * +------------------------+
     */
    // ¿Puede ser borrado?
    public function can_be_delete(){
        if($this->customers()->count()){ return false;}
        //if($this->fees()->count()){ return false;}
        if($this->payers()->count()){ return false;}
        if($this->receivers()->count()){ return false;}
        if($this->identifications()->count()){ return false;}
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
