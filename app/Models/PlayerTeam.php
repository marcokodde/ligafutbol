<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTeam extends Model
{
    use HasFactory;
    protected $table = 'player_team';
    public $timestamps = false;
    protected $fillable = [
        'player_id',
        'team_id',
    ];

    //  Equipo
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    //  Jugador
    public function player()
    {
        return $this->belongsTo(Player::class);
    }




}
