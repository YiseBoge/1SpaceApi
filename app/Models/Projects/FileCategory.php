<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsTo('App\Models\Projects\FileCategory', 'parent_category_id');
    }

    /**
     * @return HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Models\Projects\FileCategory', 'parent_category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('App\Models\Generics\File', 'file_category_file');
    }

}
