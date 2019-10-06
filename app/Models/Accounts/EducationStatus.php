<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class EducationStatus extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

     /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return MorphOne
     */
    public function file()
    {
        return $this->morphOne('App\Models\Generics\File', 'fileable');
    }
}
