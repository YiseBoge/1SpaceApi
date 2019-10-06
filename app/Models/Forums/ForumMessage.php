<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumMessage extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo('App\Models\Forums\Forum');
    }

    /**
     * @return BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('App\User');
    }
}
