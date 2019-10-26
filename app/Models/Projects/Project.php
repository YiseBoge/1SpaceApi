<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'company_id', 'title', 'description',
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
