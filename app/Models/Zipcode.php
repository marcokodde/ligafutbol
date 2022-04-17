<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    public $timestamps = false;
	protected $table = 'zipcodes';
	protected $fillable =  [
        'zipcode',
        'town',
        'type',
        'state',
        'county',
        'timezone',
        'areacode',
        'latitude',
        'longitude',
        'region',
        'country'
    ];

    /*+------------+
      | Relaciones |
      +------------+
    */

    //  Zipcode <---companies (Una zona postal tiene muchos equipos)
    public function teams(){
        return $this->hasMany(Team::class,'zipcode','zipcode');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->teams()->count()){ return false;}
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    // zipcode
    public function scopeZipcode($query,$zipcode)
    {
        if ( trim($zipcode) != "") {
           $query->where('zipcode',$zipcode);
        }
    }



}
