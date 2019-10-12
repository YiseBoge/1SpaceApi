<?php

namespace App\Models\Generics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Department findOrFail(int $id)
 * @method static Department create(array $array)
 * @property string|null remark
 * @property string|null name
 * @property string|null description
 */
class Department extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'description',
    ];

     /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

     /**
     * @return BelongsTo
     */
    public function parentDepartment()
    {
        return $this->belongsTo('App\Models\Generics\Department', 'parent_department_id');
    }

    /**
     * @return HasMany
     */
    public function subDepartments()
    {
        return $this->hasMany('App\Models\Generics\Department', 'parent_department_id');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
