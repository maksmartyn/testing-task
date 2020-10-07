<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasApiTokens, Notifiable;

    /**
     * Specifies whether timestamps are required for the model.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'name',
        'email',
        'image',
        'about',        
        'type',
        'github',
        'city',
        'is_finished',
        'phone',
        'birthday'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Define relationship.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne('App\Models\UserWorker');
    }


    /**
     * Define relationship.
     * 
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }


    /**
     * Check whether the current User has a Role.
     * 
     * @param mixed ...$roles
     * @return bool
    */
    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Check whether the current User has a Permission through his Role.
     * 
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
}
