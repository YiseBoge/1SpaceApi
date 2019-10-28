<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project\Project');
    }
}
