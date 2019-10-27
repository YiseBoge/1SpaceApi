<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static ProjectCategory findOrFail(int $id)
 * @method static ProjectCategory create(array $array)
 * @property string|null name
 * @property string|null description
 */
class ProjectCategory extends Model
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
    public function projects()
    {
        return $this->hasMany('App\Models\Projects\Project');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
