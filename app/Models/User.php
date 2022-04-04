<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /*+--------------+
      | Relaciones   |
      +--------------+
     */

    public function tasks_require(){
        return $this->hasMany(Task::class,'user_require_id');
    }

    public function tasks_responsible(){
        return $this->hasMany(Task::class,'user_responsible_id');
    }

    public function subtasks_require(){
        return $this->hasMany(Task::class,'user_require_id');
    }

    public function subtasks_responsible(){
        return $this->hasMany(Task::class,'user_responsible_id');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        if($this->tasks_require()->count()) return false;
        if($this->tasks_responsible()->count()) return false;
        if($this->subtasks_require()->count()) return false;
        if($this->subtasks_responsible()->count()) return false;
        return true;
    }

}
