<?php

namespace App\Models\Generics;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $enumTypes = [
        'ID_SCAN' => 'ID Scan',
        'PROFILE_PICTURE' => 'Profile Picture',
        'COMPANY_DOCUMENT' => 'Company Document',
        'CERTIFICATE' => 'Certificate',
        'NOTICE_DOCUMENT' => 'Notice Document',
    ];


}
