<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'tb_task_list';

    protected $fillable = [
        'id_task',
        'task_name',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relationships
    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task');
    }
}
