<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWithoutPayments extends Model
{
    use HasFactory;
    protected $table = 'users_without_payments';
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];


}
