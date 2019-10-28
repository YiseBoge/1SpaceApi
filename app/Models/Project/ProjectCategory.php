<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    /**
     * @return HasMany
     */
    public function project()
    {
        return $this->hasMany('App\Models\Project\Project');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
