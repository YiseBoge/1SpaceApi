<?php

namespace App\Models\Accounts;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static EducationStatus findOrFail(int $id)
 * @method static EducationStatus create(array $array)
 * @property DateTime start_date
 * @property DateTime end_date
 * @property string|null education_level
 * @property string|null school_name
 * @property string|null field_of_study
 */
class EducationStatus extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'education_level', 'field_of_study', 'school_name',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
