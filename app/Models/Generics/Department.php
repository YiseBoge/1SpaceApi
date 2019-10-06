<?php

namespace App\Models\Generics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Department extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
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
        return $this->belongsTo('App\Models\Generics\Department');
    }

    /**
     * @return HasMany
     */
    public function childDepartments()
    {
        return $this->hasMany('App\Models\Generics\Department', 'parent_department_id');
    }

    /**
     * @return MorphOne
     */
    public function file()
    {
        return $this->morphOne('App\Models\Generics\File', 'fileable');
    }
}
