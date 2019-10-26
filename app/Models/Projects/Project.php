<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    /**
     * @return BelongsTo
     */
    public function projectCategory()
    {
        return $this->belongsTo('App\Models\Projects\ProjectCategory');
    }

    /**
     * @return HasMany
     */
    public function coordinates()
    {
        return $this->hasMany('App\Models\Generics\Coordinate');
    }

    /**
     * @return BelongsTo
     */
    public function pmo()
    {
        return $this->belongsTo('App\Models\Projects\ProjectManagementOrganization');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
