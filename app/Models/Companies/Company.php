<?php

namespace App\Models\Companies;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Company findOrFail(int $id)
 * @method static Company create(array $array)
 * @property string|null name
 * @property string|null description
 * @property string|null category
 */
class Company extends Model
{
    use SoftDeletes;
    use Enums;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'description', 'category'
    ];

    protected $enumCategories = [
        'Contractor',
        'Consultant',
    ];


    /**
     * @return HasMany
     */
    public function departments()
    {
        return $this->hasMany('App\Models\Companies\Department')->where('parent_department_id', null);
    }

    /**
     * @return HasMany
     */
    public function positions()
    {
        return $this->hasMany('App\Models\Companies\Position');
    }

    /**
     * @return HasMany
     */
    public function roles()
    {
        return $this->hasMany('App\Models\Companies\Role');
    }
}
