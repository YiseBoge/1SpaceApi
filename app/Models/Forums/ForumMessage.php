<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumMessage extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];
}
