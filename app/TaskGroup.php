<?php

namespace App;

use App\Observers\TaskGroupObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
    protected $table = 'task_group';

    protected static function boot()
    {
        parent::boot();

        static::observe(TaskGroupObserver::class);

    }
}
