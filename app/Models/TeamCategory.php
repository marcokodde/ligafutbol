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
        'registered_teams'
    ];

    //  Pago-->Usuario (Un Pago pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Categorias cubiertas por el pago
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    // Un pago pertenece a
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function can_be_delete()
    {
        return false;
    }
    public function scopeUserId($query, $user_id)
    {
        $query->where('user_id', $user_id);
    }

    // Con equipos pendientes
    public function scopeWithPendingTeams($query)
    {
        $query->where('qty_teams', '>', 'registered_teams');
    }

    // De apoyo
    public function update_registered_teams()
    {
        $this->registered_teams++;
        $this->save();
    }
}
