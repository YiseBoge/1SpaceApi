<?php

namespace App\Models\Accounts;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ContactPerson extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $enumTypes = [
        'EMERGENCY_CONTACT' => 'Emergency Contact',
        'VOUCHER' => 'Voucher',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Generics\Address');
    }

    /**
     * @return MorphOne
     */
    public function file()
    {
        return $this->morphOne('App\Models\Generics\File', 'fileable');
    }
}
