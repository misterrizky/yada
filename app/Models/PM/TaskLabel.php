<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskLabel extends Model
{
    use HasFactory;
    public function taskLabelTasks(): HasMany
    {
        return $this->hasMany(TaskLabelTask::class, 'task_label_id');
    }
}
