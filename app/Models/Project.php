<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'tb_project';

    protected $fillable = [
        'id_company',
        'project_name',
        'description',
        'category',
        'status'
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'id_projects');
    }
}
