<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivateMessage extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];
}
