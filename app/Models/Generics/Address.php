<?php

namespace App\Models\Generics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Address findOrFail(int $id)
 * @method static Address create(array $array)
 * @property string|null region
 * @property string|null zone
 * @property string|null woreda
 * @property string|null city
 * @property string|null sub_city
 * @property string|null kebele
 * @property string|null block_no
 * @property string|null house_no
 */
class Address extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'region', 'zone', 'woreda', 'city', 'sub_city', 'kebele', 'block_no', 'house_no',
    ];

     /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * @return HasOne
     */
    public function contactPerson()
    {
        return $this->hasOne('App\Models\Accounts\ContactPerson');
    }
}
