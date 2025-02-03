<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talent extends Model
{
    use HasFactory;

    protected $table = 'tb_talent';

    protected $fillable = [
        'id_users',
        'field',
        'linkedin',
        'url_portfolio',
        'token',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'id_talent');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'id_talent');
    }

}
