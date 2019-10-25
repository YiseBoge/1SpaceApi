<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectFileCategory extends Model
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
    public function subCategory()
    {
        return $this->hasMany('App\Models\Project\ProjectFileSubCategory');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }

}
