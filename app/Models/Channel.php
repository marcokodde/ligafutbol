<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    public $timestamps = false;
    protected $fillable =  [
        'channel',
        'short'
    ];

    // Setters
    public function setChannelAttribute($value)
    {
        $this->attributes['channel'] =  ucwords(strtolower($value));
    }


    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete()
    {
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */


    public function scopeChannel($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('channel', 'LIKE', "%$valor%")
                ->orwhere('short', 'LIKE', "%$valor%");
        }
    }
    public function scopeShort($query, $valor)
    {
        if (trim($valor) != "") {
            $query->where('short', 'LIKE', "%$valor%");
        }
    }
}
