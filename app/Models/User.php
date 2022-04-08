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

class User extends Authenticatable implements MustVerifyEmail
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

    /*+-------------+
      | Apoyo       |
      +-------------+
     */

     public function isActive(){
         return $this->active;
     }

    /*+-------------+
      | Búsquedas   |
      +-------------+
     */
    public function scopeSearch($query,$valor){
        $query->where('name','LIKE',"%$valor%")
              ->orwhere('email','LIKE',"%$valor%")
              ->orwhere('phone','LIKE',"%$valor%");
    }

    public function scopeName($query,$valor){
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

    public function scopeEmail($query,$valor){
        if ( trim($valor) != "") {
            $query->where('email','LIKE',"%$valor%");
         }
    }

    public function scopePhone($query,$valor){
        if ( trim($valor) != "") {
            $query->where('phone','LIKE',"%$valor%");
         }
    }

}
