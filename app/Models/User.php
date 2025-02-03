<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_users';

    // Role constants
    public const ROLES = [
        'admin',
        'writer',
        'talent',
        'company',
    ];

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'profile_picture',
        'role',
        'is_blocked',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_blocked' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Validate role.
     */
    public function isValidRole($role): bool
    {
        return in_array($role, self::ROLES);
    }

    /**
     * Password setter (automatically hash).
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }



    // Relationships
    public function talent()
    {
        return $this->hasOne(Talent::class, 'id_users');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id_users');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'id_users');
    }

    public function managedTasks()
    {
        return $this->hasMany(Task::class, 'id_project_manager');
    }
}
