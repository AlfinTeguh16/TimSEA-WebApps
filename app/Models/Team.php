<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $tabel = 'tb_team';
    protected $fillable = [
        'id_talent',
        'id_projects',
    ];

    // Relationships
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'id_talent');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_projects');
    }
}
