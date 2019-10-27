<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Coordinate findOrFail(int $id)
 * @method static Coordinate create(array $array)
 * @property float value_x
 * @property float value_y
 */
class Coordinate extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'project_id', 'value_x', 'value_y',
    ];


    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\ProjectsProject');
    }
}
