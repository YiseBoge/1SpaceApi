<?php

namespace App\Models\Reminders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function poster()
    {
        return $this->belongsTo('App\User', 'poster_id');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'reminder_user');
    }
}
