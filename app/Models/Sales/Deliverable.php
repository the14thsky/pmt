<?php

namespace App\Models\Sales;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deliverable
 * @package App\Models\Sales
 * @version November 19, 2020, 2:56 am UTC
 *
 * @property \App\Models\Sales\Project $project
 * @property integer $project_id
 * @property string $title
 * @property string $deliverables
 */
class Deliverable extends Model
{
    use SoftDeletes;

    public $table = 'deliverables';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'project_id',
        'title',
        'task',
        'party',
        'predecessor',
        'budget_group',
        'duration',
        'start_date',
        'end_date',
        'status',
        'man_hours'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
        'title' => 'string',
        'task' => 'string',
        'party' => 'string',
        'predecessor' => 'string',
        'budget_group' => 'string',
        'duration' => 'integer',
        'man_hours' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|unique:deliverables',
        'deliverables' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function project()
    {
        return $this->belongsTo(\App\Models\Sales\Project::class);
    }
}
