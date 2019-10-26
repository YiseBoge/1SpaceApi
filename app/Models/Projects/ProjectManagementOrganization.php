<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectManagementOrganization extends Model
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
    public function parentPMO()
    {
        return $this->belongsTo('App\Models\Projects\ProjectManagementOrganization', 'parent_pmo_id');
    }

    /**
     * @return HasMany
     */
    public function subPMOs()
    {
        return $this->hasMany('App\Models\Projects\ProjectManagementOrganization', 'parent_pmo_id');
    }

    /**
     * @return HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Projects\Project');
    }

    /**
     * @return HasMany
     */
    public function teamMembers()
    {
        return $this->hasMany('App\Models\Accounts\TeamMember', 'pmo_id');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
