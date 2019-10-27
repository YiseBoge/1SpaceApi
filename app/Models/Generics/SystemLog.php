<?php

namespace App\Models\Generics;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static SystemLog findOrFail(int $id)
 * @property string|null action_type
 * @property string|null remark
 */
class SystemLog extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $enumActionTypes = [

    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'actor_id');
    }

    /**
     * @return BelongsTo
     */
    public function target()
    {
        return $this->morphTo();
    }
}
