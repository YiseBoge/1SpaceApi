<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Role findOrFail(int $id)
 * @method static Role create(array $array)
 * @property string|null remark
 * @property string|null name
 * @property string|null description
 * @property bool can_add_user
 * @property bool can_edit_user
 * @property bool can_delete_user
 * @property bool can_activate_user
 * @property bool can_deactivate_user
 * @property bool can_assign_user_admin
 * @property bool can_generate_user_cv
 * @property bool can_generate_user_report
 * @property bool can_assign_organogram_admin
 * @property bool can_add_department
 * @property bool can_edit_department
 * @property bool can_delete_department
 * @property bool can_add_position
 * @property bool can_edit_position
 * @property bool can_delete_position
 * @property bool can_add_professional_role
 * @property bool can_edit_professional_role
 * @property bool can_delete_professional_role
 * @property bool can_assign_project_admin
 * @property bool can_add_project
 * @property bool can_delete_project
 * @property bool can_evaluate_project
 * @property bool can_generate_project_report
 */
class Role extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'description', 'quantity_needed',
    ];

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Companies\Company');
    }

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }
}
