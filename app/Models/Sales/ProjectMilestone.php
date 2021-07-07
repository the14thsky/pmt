<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMilestone extends Model
{
    use SoftDeletes;
    public $table='project_milestones';

    public $fillable= [
        'project_id',
        'milestone',
        'percentage',
        'amount',
        'can_invoice',
        'can_invoice_date',
        'can_invoice_updated_by',
        'invoice_sent',
        'invoice_sent_date',
        'invoice_sent_updated_by'
    ];

}
