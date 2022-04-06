<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

trait UserTrait {


    /**
	 * Relación con PERMISOS
	 */

	// public function permissions() {
	// 	return $this->belongsToMany(Permission::class)->withTimesTamps();
	// }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function this_permission(Permission $permission){
        return $this->belongsToMany(Permission::class)->where('permission_id',$permission->id)->count();
    }

	/**
	 * Relación con: ROLES
	 */

	public function roles() {
		return $this->belongsToMany(Role::class)->withTimesTamps();
	}

	public function roles_by_name() {
		return $this->belongsToMany(Role::class)->withTimesTamps()->orderby('role');
	}

/*+---------------------------------+
  | ¿El usuario tiene el permiso?   |
  +---------------------------------+
  | Si usuario tiene empresa o no   |
  +---------------------------------+
*/
	public function hasPermission($permission) {
        $permission_record = Permission::where('slug',$permission)->first();
        if($permission_record && $this->this_permission($permission_record)->count()){
            return true;
        }

		foreach (Auth::user()->roles as $role) {
			if ($role->full_access) {
				return true;
			};

			foreach ($role->permissions as $role_permission) {
				if ($role_permission->slug == $permission) {
					return true;
				}
			}
		}
		return false;
    }

    public function hasRole($role){
        foreach($this->roles as $rol){
            if($role == $rol->english || $role == $rol->spanish ){
                return true;
            }
        }
        return false;
    }


    public function is($role){
        return $this->hasRole($role);
    }


    public function isAdmin(){
        return $this->is('admin');
    }

    public function isLicence(){
        return $this->is('licence');
    }
    public function isDesignLead(){
        return $this->is('DesignLead');
    }

    public function isDeptoLead(){
        return $this->is('DeptoLead');
    }

    public function isAccountManager(){
        return $this->is('AccountManager');
    }

    public function isSocialAgent(){
        return $this->is('SocialAgent');
    }

    public function isBrandDesigner(){
        return $this->is('BrandDesigner');
    }

    public function isGraphDesigner(){
        return $this->is('GraphDesigner');
    }

    public function isDeveloper(){
        return $this->is('Developer');
    }

}
