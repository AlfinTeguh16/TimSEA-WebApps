<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Writer extends Model
{
    use HasFactory;

    protected $table = 'tb_writer';

    protected $fillable = [
        'id_users',
        'profile_picture',
    ];
}
