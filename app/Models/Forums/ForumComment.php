<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumComment extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'comment',
    ];

    /**
     * @return BelongsTo
     */
    public function forumPost()
    {
        return $this->belongsTo('App\Models\Forums\ForumPost');
    }

    /**
     * @return BelongsTo
     */
    public function commenter()
    {
        return $this->belongsTo('App\User', 'commenter_id');
    }
}
