<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tb_task';
    protected $fillable = [
        'id_project',
        'id_project_manager',
        'task_title',
        'deadline',
        'status'
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Talent::class, 'id_project');
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'id_project_manager');
    }

    public function taskLists()
    {
        return $this->hasMany(TaskList::class, 'id_task');
    }
}
