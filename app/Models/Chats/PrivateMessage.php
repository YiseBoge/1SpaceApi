<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
//        'sender_id', 'receiver_id', 'subject', 'content',
        'content',
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
    public function conversation()
    {
        return $this->belongsTo('App\Models\Chats\Conversation');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }


    /**
     * @return HasMany
     */
    public function forwardedMessages()
    {
        return $this->HasMany('App\Models\Chats\PrivateMessage', 'parent_message_id');
    }
}
