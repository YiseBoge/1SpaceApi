<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static PrivateMessage findOrFail($id)
 * @method static PrivateMessage create(array $array)
 * @property boolean is_important
 * @property integer parent_message_id
 * @property integer sender_id
 * @property integer receiver_id
 * @property string|null subject
 * @property string|null content
 */
class PrivateMessage extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'subject', 'content',
    ];

    /**
     * @return BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    /**
     * @return BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    /**
     * @return BelongsTo
     */
    public function parentMessage()
    {
        return $this->belongsTo('App\Models\Chats\PrivateMessage', 'parent_message_id');
    }

    /**
     * @return HasOne
     */
    public function forwardedMessage()
    {
        return $this->HasOne('App\Models\Chats\PrivateMessage', 'parent_message_id');
    }
}
