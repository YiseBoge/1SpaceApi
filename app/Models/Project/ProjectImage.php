<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project\Project');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
