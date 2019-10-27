<?php

namespace App\Models\Notices;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Notice findOrFail(int $id)
 * @method static Notice create(array $array)
 * @property DateTime|null target_date
 * @property DateTime|null remind_before
 * @property string|null title
 * @property string|null description
 */
class Notice extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'poster_id', 'title', 'description',
    ];

    /**
     * @return BelongsTo
     */
    public function poster()
    {
        return $this->belongsTo('App\User', 'poster_id');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'notice_user');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
