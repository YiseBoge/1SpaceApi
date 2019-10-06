<?php

namespace App\Models\Forums;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->belongsTo('App\User');
    }

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * @return HasMany
     */
    public function forumMessages()
    {
        return $this->hasMany('App\Models\Forums\Forum');
    }
}
