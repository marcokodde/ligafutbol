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
        'max_teams_by_category',
        'active_coupon',
        'key_to_coupon',
        'players_only_available_teams',
        'coaches_only_available_teams',

    ];

    // Setters
    public function setKeyToCouponAttribute($value)
    {
        $this->attributes['key_to_coupon'] =  strtolower(trim($value));
    }

    public function can_be_delete(){
        return false;
    }

}
