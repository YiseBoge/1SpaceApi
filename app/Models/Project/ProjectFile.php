<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
     /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project\Project');
    }

    /**
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Models\Project\ProjectFileCategory');
    }

    /**
     * @return HasOne
     */
    public function subCategory()
    {
        return $this->hasOne('App\Models\Project\ProjectFileSubCategory');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }

}
