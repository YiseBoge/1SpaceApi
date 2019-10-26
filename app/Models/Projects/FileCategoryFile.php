<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileCategoryFile extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    public $incrementing = false;
    protected $primaryKey = null;
}
