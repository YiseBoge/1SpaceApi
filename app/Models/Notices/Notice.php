<?php

namespace App\Models\Notices;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];
}
