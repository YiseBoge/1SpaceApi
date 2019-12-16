<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static ForumPost findOrFail(array|string|null $input)
 * @method static ForumPost create(array $array)
 * @property string|null content
 * @property integer likes
 */
class ForumPost extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'forum_id', 'content',
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

    /**
     * @return BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany('App\User', 'forum_post_likes');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }

    public function getFileUrl(){
        if ($file = $this->files->where('file_type','POST_IMAGE')->first()) {
            return env('APP_URL').'/storage'.$file->file_url;

        }

        return null;
    }

    public function getAttachment(){
        return $this->files->where('file_type', 'POST_ATTACHMENT')->first();
    }
}
