<?php

namespace App\Models\Accounts;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static ContactPerson create(array $array)
 * @method static ContactPerson findOrFail(int $id)
 * @property int address_id
 * @property string|null personal_name
 * @property string|null father_name
 * @property string|null grand_father_name
 * @property string|null sex
 * @property string|null phone_number
 * @property string|null employer_company
 * @property string|null type
 */
class ContactPerson extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'user_id', 'personal_name', 'father_name', 'grand_father_name', 'sex', 'phone_number', 'employer_company',
    ];

    protected $enumTypes = [
        'Emergency Contact',
        'Voucher',
    ];

    protected $enumSexes = [
        'Male',
        'Female',
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
