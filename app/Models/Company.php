<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $table = 'tb_company';

    protected $fillable = [
        'id_users',
        'company',
        'country',
        'phone',
        'profile_picture',
        'description',
        'field',
        'linkedin',
    ];
}
