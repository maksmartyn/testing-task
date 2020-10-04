<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Define relationship.
     * 
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }


    /**
     * Check whether the current Role has a Permission.
     * 
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }


    /**
     * Get all Permissions for Role.
     * 
     * @param array $permissions
     * @return mixed
     */
    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }


    /**
     * Give permissions for Role.
     * 
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }


    /**
     * Delete permissions.
     * 
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }


    /**
     * Refresh permissions.
     * 
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }
}
