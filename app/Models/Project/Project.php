<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * @return BelongsTo
     */
    public function projectCategory()
    {
        return $this->belongsTo('App\Models\Project\ProjectCategory');
    }

    /**
     * @return HasMany
     */
    public function projectFiles()
    {
        return $this->hasMany('App\Models\Project\ProjectFile');
    }

    /**
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Models\Project\ProjectImage');
    }

    /**
     * @return HasOne
     */
    public function location()
    {
        return $this->hasOne('App\Models\Project\ProjectLocation');
    }

    /**
     * @return HasOne
     */
    public function projectManagementOrganization()
    {
        return $this->hasOne('App\Models\Project\ProjectManagementOrganization');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
