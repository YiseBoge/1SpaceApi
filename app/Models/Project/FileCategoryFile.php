<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileCategoryFile extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected $primaryKey = null;
}
