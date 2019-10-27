<?php

namespace App\Models\Generics;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static File findOrFail(int $id)
 * @method static File create(array $array)
 * @property string|null file_name
 * @property string|null
 * @property string|null file_type
 * @property string|null file_url
 * @property string|null file_description
 */
class File extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $enumTypes = [
        'Project File',
        'ID Scan',
        'Profile Picture',
        'Company Document',
        'Certificate',
        'Notice Document',
        'Other'
    ];

    /**
     * Get the owning fileable model.
     */
    public function fileable()
    {
        return $this->morphTo();
    }


    /**
     * @return mixed
     */
    public function projectFileCategory()
    {
        return $this->belongsToMany('App\Models\Projects\FileCategory', 'file_category_file');
    }

}
