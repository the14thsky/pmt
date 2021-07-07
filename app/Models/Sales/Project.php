<?php

namespace App\Models\Sales;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 * @package App\Models\Sales
 * @version November 17, 2020, 3:00 am UTC
 *
 * @property \App\Models\Sales\Opportunity $opportunity
 * @property \App\Models\Sales\Customer $customer
 * @property integer $opportunity_id
 * @property integer $customer_id
 * @property string $project_code
 * @property integer $status
 */
class Project extends Model
{
    use SoftDeletes;

    public $table = 'projects';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'opportunity_id',
        'customer_id',
        'project_code',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'opportunity_id' => 'integer',
        'customer_id' => 'integer',
        'project_code' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'opportunity_id' => 'required',
        'customer_id' => 'required',
        'project_code' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function opportunity()
    {
        return $this->belongsTo(\App\Models\Sales\Opportunity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\App\Models\Sales\Customer::class);
    }

    public function getStatusAttribute(){
        switch ($this->attributes['status']) {
            case 1:
                return 'Not Started';
                break;
            case 2:
                return 'In Progress';
            default:
                # code...
                break;
        }
    }

    public function deliverable()
    {
        return $this->hasMany('\App\Models\Sales\Deliverable');
    }
}
