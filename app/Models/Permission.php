<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'pivot',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
    public function hasUser($user)
    {
        return $this->users()->where('name', $user)->exists();
    }
}
