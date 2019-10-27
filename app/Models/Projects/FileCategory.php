<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static FileCategory findOrFail(int $id)
 * @method static FileCategory create(array $array)
 */
class FileCategory extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'description'
    ];

    /**
     * @return BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo('App\Models\Projects\FileCategory');
    }

    /**
     * @return HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Models\Projects\FileCategory');
    }

    /**
     * @return HasManyThrough
     */
    public function files()
    {
        return $this->hasManyThrough('App\Models\Generics\File', 'App\Models\Project\FileCategoryFile');
    }

}
