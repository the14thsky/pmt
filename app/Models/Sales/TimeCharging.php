<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeCharging extends Model
{
    use SoftDeletes;
    public $table='time_chargings';

    public $fillable= [
        'project_id',
        'deliverable_id',
        'man_hour',
        'updated_by'
    ];


    /**
     * Get the deliverable that owns the TimeCharging
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id', 'id');
    }

}
