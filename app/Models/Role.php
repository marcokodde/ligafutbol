<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
        'name','english', 'spanish','full_access',
	];

	public function users() {
		return $this->belongsToMany(User::class);
	}

	public function permissions() {
		return $this->belongsToMany(Permission::class);
	}

	public function permissions_by_name() {
		return $this->belongsToMany(Permission::class)->orderby('name');
	}

	public function hasPermissions() {
		return $this->permissions->count();
	}

	// ¿Puede ser borrado?
	public function can_be_delete(){
		if($this->permissions()->count()){ return false;}
		if($this->users()->count()){ return false;}
		return true;
	}

     /*+------------+
      | Busquedas   |
      +-------------+
    */

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }


    public function scopeSpanish($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('spanish','LIKE',"%$valor%");
         }
    }


    public function scopeEnglish($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('english','LIKE',"%$valor%");
         }
    }
}
