<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class,'user_id','id');
    }


    public static function userCan($argPermissions)
    {
        $user = Auth::user();
        $role = Roles::find($user->role_id);
        $permissions = Permission::whereIn('id',json_decode($role->permissions))->get('name');
        $arrPermission = [];

        foreach($permissions as $permission)
        {
            $arrPermission[] = $permission->name;
        }
        foreach($argPermissions as $argPermission)
        {
            if(in_array($argPermission,$arrPermission))
            {
                return true;
            }
        }
        
        return false;
    }

    public static function isAdmin($id)
    {
        $user = Auth::user();
        $role = Roles::find($user->role_id);
        if($role->name != 'Admin')
        {
            if($id != $user->id)
            {
                abort(404);
            }
            $isAdmin = false;
        }
        else
        {
            $isAdmin = true;
        }

        return $isAdmin;
    }
}
