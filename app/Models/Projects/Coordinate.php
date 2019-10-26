<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coordinate extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'value',
    ];


    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\ProjectsProject');
    }
}
