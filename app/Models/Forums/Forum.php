<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];
}
