<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class FileCategory extends Model
{
    /**
     * @return BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo('App\Models\Project\FileCategory');
    }

    /**
     * @return HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Models\Project\FileCategory');
    }

    /**
     * @return HasManyThrough
     */
    public function files()
    {
        return $this->hasManyThrough('App\Models\Generics\File', 'App\Models\Project\FileCategoryFile');
    }

}
