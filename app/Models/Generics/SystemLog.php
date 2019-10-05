<?php

namespace App\Models\Generics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemLog extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];
}
