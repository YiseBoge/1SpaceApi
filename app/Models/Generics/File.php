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

    /**
     * Get the owning fileable model.
     */
    public function fileable()
    {
        return $this->morphTo();
    }

    protected $enumTypes = [
        'ID Scan',
        'Profile Picture',
        'Company Document',
        'Certificate',
        'Notice Document',
    ];


}