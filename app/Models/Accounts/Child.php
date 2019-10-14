<?php

namespace App\Models\Accounts;

use App\Traits\Enums;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Child findOrFail(int $id)
 * @method static create(array $array)
 * @property string|null name
 * @property string|null sex
 * @property DateTime birth_date
 */
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
