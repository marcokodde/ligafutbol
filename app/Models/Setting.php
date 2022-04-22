<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable =  [
        'name',
        'max_players_by_team',
        'players_only_available_teams',
        'coaches_only_available_teams',
    ];


    public function can_be_delete(){
        return false;
    }

}
