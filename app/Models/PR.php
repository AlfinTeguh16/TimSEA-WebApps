<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PR extends Model
{
    protected $table = 'tb_pr';

    protected $fillable = [
        'id_company',
        'title',
        'URL',
        'author',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }

}
