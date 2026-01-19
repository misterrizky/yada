<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskLabelTask extends Pivot
{
    use HasFactory;
    protected $table = 'task_label_task';

    public $incrementing = false;

    public $timestamps = false;

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function taskLabel(): BelongsTo
    {
        return $this->belongsTo(TaskLabel::class, 'task_label_id');
    }
}
