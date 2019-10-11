<?php

namespace App\Models\Accounts;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'sex', 'birth_date',
    ];

    protected $enumSexes = [
        'Male',
        'Female',
    ];

    /**
     * @return BelongsTo
     */
    public function familyStatus()
    {
        return $this->belongsTo('App\Models\Accounts\FamilyStatus');
    }

}
