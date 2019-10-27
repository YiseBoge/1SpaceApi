<?php

namespace App\Models\Projects;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Project findOrFail(int $id)
 * @method static Project create(array $array)
 * @property string|null name
 * @property string|null description
 * @property string|null client
 * @property DateTime start_date
 * @property string|null latitude
 * @property string|null longitude
 */
class Project extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'pmo_id', 'project_category_id', 'name', 'description', 'client', 'start_date',
    ];

    /**
     * @return BelongsTo
     */
    public function projectCategory()
    {
        return $this->belongsTo('App\Models\Projects\ProjectCategory');
    }

    /**
     * @return HasMany
     */
    public function coordinates()
    {
        return $this->hasMany('App\Models\Generics\Coordinate');
    }

    /**
     * @return BelongsTo
     */
    public function pmo()
    {
        return $this->belongsTo('App\Models\Projects\ProjectManagementOrganization', 'pmo_id');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
