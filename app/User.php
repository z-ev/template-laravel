<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Doc: https://laravel.com/docs/7.x/sanctum
use Laravel\Sanctum\HasApiTokens;

// Custom permissions
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_key'
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

    public function userAgents()
    {
        return $this->hasMany('App\UserAgent');
    }

    public function permissionRoutes()
    {
        $permissions = config('permissions');
        $permissionRoutes = collect();
        $routes = collect(Route::getRoutes());

        foreach (($this->id != 1) ? $permissions[$this->role_key] : ['*'] as $permission) {
            $permissionRoutes->push($routes->filter(function ($value) use ($permission) {
                return Str::is($permission, $value->getName()) ? $value->getName() : false;
            })->map(function ($item) { return $item->getName(); }));
        }

        return $permissionRoutes->flatten();
    }
}
