<?php

namespace App\Models\Generics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
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
