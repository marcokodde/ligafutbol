<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matche extends Model
{

    protected $fillable =  [
        'date',
        'game_id',
        'tournament_id',
        'referee_id',
        'stadium_id',
        'goals',
        'local_changes',
        'visit_changes',
        'total_players',
    ];

    protected $casts = [
        'goals' => 'json', // Para convertir el campo "goals" en un array JSON
    ];

    public function addGoal($playerId, $minute)
    {
        $goals = $this->goals ?? [];
        $goals[] = ['player_id' => $playerId, 'minute' => $minute];
        $this->goals = $goals;
        $this->save();
    }

    // En el modelo Match.php
    public function arbitrators()
    {
        return $this->belongsToMany(Referee::class);
    }

    public function localPlayers()
    {
        return $this->belongsToMany(Player::class, 'match_team_player', 'match_id', 'player_id')
            ->wherePivot('team_id', $this->local_team_id);
    }

    public function visitorPlayers()
    {
        return $this->belongsToMany(Player::class, 'match_team_player', 'match_id', 'player_id')
            ->wherePivot('team_id', $this->visitor_team_id);
    }
}
