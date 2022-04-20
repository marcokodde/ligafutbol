<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
		'description',
        'user_id',
        'source',
        'address',
        'zipcode',
        'phone',
    ];

     //  Pago-->Usuario (Un Pago pertenece a un usuario)
     public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    //PAgo-->Evento (Un Pago  pertenece a una reservacion)

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'team_id','id');
    }
}
