<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectFileSubCategory extends Model
{
    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Project\ProjectCategory');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
