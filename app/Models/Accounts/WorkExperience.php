<?php

namespace App\Models\Accounts;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static WorkExperience findOrFail(int $id)
 * @method static WorkExperience create(array $array)
 * @property DateTime start_date
 * @property DateTime end_date
 * @property string|null role
 * @property string|null position
 * @property string|null department
 * @property string|null company_name
 */
class WorkExperience extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'user_id', 'company_name', 'department', 'position', 'role', 'start_date', 'end_date'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return MorphOne
     */
    public function file()
    {
        return $this->morphOne('App\Models\Generics\File', 'fileable');
    }
}
