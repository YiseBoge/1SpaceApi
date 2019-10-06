<?php

namespace App\Models\Forums;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $enumTypes = [

    ];

    /**
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'forum_user');
    }

    /**
     * @return HasMany
     */
    public function forumMessages()
    {
        return $this->hasMany('App\Models\Forums\Forum');
    }
}
