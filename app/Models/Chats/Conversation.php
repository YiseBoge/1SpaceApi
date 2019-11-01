<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Conversation findOrFail(int $id)
 */
class Conversation extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [

    ];

    /**
     * @return BelongsTo
     */
    public function starter()
    {
        return $this->belongsTo('App\User', 'starter_id');
    }

    /**
     * @return BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->HasMany('App\Models\Chats\PrivateMessage');
    }
}
