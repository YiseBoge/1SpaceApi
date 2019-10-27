<?php

namespace App\Models\Accounts;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static FamilyStatus findOrFail(array|string|null $input)
 * @method static FamilyStatus create(array $array)
 * @property mixed status
 * @property string|null partner_name
 */
class FamilyStatus extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'user_id', 'status',
    ];

    protected $enumTypes = [
        'Married',
        'Single',
        'Divorced',
        'Widowed',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Models\Accounts\Child');
    }
}
