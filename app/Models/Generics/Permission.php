<?php

namespace App\Models\Generics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Permission findOrFail(int $id)
 * @method static Permission create(array $array)
 * @property string|null action
 */
class Permission extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'action',
    ];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'permission_user');
    }

}
