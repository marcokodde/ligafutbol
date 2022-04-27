<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{
    use HasFactory;
    protected $table = 'team_categories';
    protected $fillable = [
        'user_id',
        'category_id',
        'payment_id',
        'qty_teams',
    ];

     //  Pago-->Usuario (Un Pago pertenece a un usuario)
     public function user() {
        return $this->belongsTo(User::class);
    }

    // Categorias cubiertas por el pago
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

      // Un pago pertenece a
    public function payment()
    {
        return $this->belongsTo(payment::class);
    }
    public function can_be_delete(){
        return false;
    }
}