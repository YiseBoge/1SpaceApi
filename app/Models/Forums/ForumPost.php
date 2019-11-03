<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * @return MorphOne
     */
    public function file()
    {
        return $this->morphOne('App\Models\Generics\File', 'fileable');
    }

    public function getFileUrl(){
        if ($this->file) {
            return env('APP_URL').'/storage'.$this->file->file_url;

        }

        return null;
    }
}
