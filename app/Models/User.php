<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UserTrait;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use UserTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'token_register_teams',
        'token_register_players',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function teams_not_enabled()
    {
        return $this->hasMany(Team::class)->where('enabled', 0);
    }

    public function coaches()
    {
        return $this->hasMany(Coach::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    // TeamCategory -> que le pertenecen al usuario
    public function teams_categories()
    {
        return $this->hasMany(TeamCategory::class);
    }

    /*+-------------+
      | Apoyo       |
      +-------------+
     */

    public function isActive()
    {
        return $this->active;
    }

    // Borra token para registro de equipos
    public function delete_token_to_register_teams()
    {
        $this->token_register_teams = null;
        $this->save();
    }

    //  Borra token para registro de jugadores
    public function delete_token_to_register_players()
    {
        $this->token_register_players = null;
        $this->save();
    }

    /*+-------------+
      | Búsquedas   |
      +-------------+
     */
    public function scopeSearch($query, $valor)
    {
        $query->where('name', 'LIKE', "%$valor%")
            ->orwhere('email', 'LIKE', "%$valor%")
            ->orwhere('phone', 'LIKE', "%$valor%");
    }

    public function scopeName($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('name', 'LIKE', "%$valor%");
        }
    }

    public function scopeEmail($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('email', 'LIKE', "%$valor%");
        }
    }

    public function scopePhone($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('phone', 'LIKE', "%$valor%");
        }
    }

    public function scopeTokenRegisterTeams($query, $token)
    {
        $query->where('token_register_teams', trim($token));
    }
}
