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
        'promoter_id',
        'source',
        'address',
        'zipcode',
        'phone',
    ];



    // Total de equipos cubiertos por el pago
    public function team_categories()
    {
        return $this->hasMany(TeamCategory::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }

    //  Pago-->Usuario (Un Pago pertenece a un usuario)
    public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //  Pago-->Promotor (Un Pago pertenece a un promotor)
    public function prometer() {
        return $this->belongsTo(Promoter::class, 'promoter_id', 'id');
    }

}
