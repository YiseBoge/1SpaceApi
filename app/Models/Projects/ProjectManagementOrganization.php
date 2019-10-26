<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProjectManagementOrganization extends Model
{
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
        return $this->hasMany('App\Models\Accounts\TeamMember');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
