<?php

namespace App\Models\Companies;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->hasMany('App\Models\Companies\Department');
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
