<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory;
    protected $table = 'rounds';
    public $timestamps = false;
    protected $fillable =  [
        'from',
        'to',
        'active',
    ];

    protected $casts = [
        'from' => 'datetime:Y-m-d',
        'to' => 'datetime:Y-m-d',
    ];

    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function can_be_delete(){
        if($this->games()->count()) return false;
        return true;
    }

    public function isActive(){
        return $this->active;
    }


    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeActiveRound($query)
    {
        $query->filter(function($item) {
            if (Carbon::now()->between($item->from, $item->to)) {
              return $item;
            }
          });
    }

    public function scopeRound($query,$from,$to)
    {
        $query->where('from','>=',$from)
              ->where('to','<=',$to);
    }


}
