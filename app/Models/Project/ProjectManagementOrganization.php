<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectManagementOrganization extends Model
{
    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project\Project');
    }

    /**
     * @return HasMany
     */
    public function teamMember()
    {
        return $this->hasMany('App\Models\Accounts\ProjectTeamMember');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
