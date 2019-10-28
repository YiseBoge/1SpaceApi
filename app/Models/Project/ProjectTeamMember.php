<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectTeamMember extends Model
{
    /**
     * @return BelongsTo
     */
    public function projectManagementOrganization()
    {
        return $this->belongsTo('App\Models\Project\ProjectManagementOrganization');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
