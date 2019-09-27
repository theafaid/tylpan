<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasStatus;

    protected $guarded = [];
    protected $appends = ['formattedStatus'];
    protected $with = ['founder', 'founder'];

    /**
     * Get the task-based on user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskBased()
    {
        return $this->belongsTo(User::class, 'task_for', 'id');
    }

    /**
     * Get the creator of the task
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function founder()
    {
       return $this->belongsTo(User::class, 'task_from', 'id');
    }

    /**
     * Get the order related to the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
