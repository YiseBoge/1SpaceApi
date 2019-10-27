<?php

namespace App\Models\Generics;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'file_name', 'file_url', 'file_type',
    ];

    protected $enumTypes = [
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


    public function projectFileCategory()
    {
        return $this->hasOneThrough('App\Models\Projects\FileCategory', 'App\Models\Projects\FileCategoryFile', 'file_id', 'id', 'id', 'file_category_id');
    }

}
