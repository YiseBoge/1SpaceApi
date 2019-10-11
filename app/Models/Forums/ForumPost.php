<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'content',
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
    public function poster()
    {
        return $this->belongsTo('App\User', 'poster_id');
    }

    /**
     * @return HasMany
     */
    public function forumComments()
    {
        return $this->hasMany('App\Models\Forums\ForumComment');
    }
}
