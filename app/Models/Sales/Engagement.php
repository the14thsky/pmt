<?php

namespace App\Models\Sales;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Engagement
 * @package App\Models\Sales
 * @version November 12, 2020, 3:08 am UTC
 *
 * @property \App\Models\Sales\Customer $customer
 * @property \App\Models\Sales\Opportunity $opportunity
 * @property integer $customer_id
 * @property integer $opportunity_id
 * @property string $type
 * @property string $brief_description
 * @property string $attachment
 * @property string $follow_up
 * @property string $action_item
 * @property string $dateline
 */
class Engagement extends Model
{
    use SoftDeletes;

    public $table = 'engagements';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'customer_id',
        'opportunity_id',
        'type',
        'brief_description',
        'attachment',
        'follow_up',
        'action_item',
        'dateline'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'type' => 'string',
        'attachment' => 'string',
        'follow_up' => 'string',
        'dateline' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'customer_id' => 'required',
        // 'opportunity_id' => 'required',
        'type' => 'required',
        'follow_up' => 'required',
        'dateline' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\App\Models\Sales\Customer::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(\App\Models\Sales\Opportunity::class);
    }

    public function setDatelineAttribute($value){
        $carbon = new Carbon();
        $this->attributes['dateline'] =  $carbon->parse($value);
    }

    public function getDatelineAttribute(){
        $carbon = new Carbon($this->attributes['dateline']);
        return $carbon->isoFormat('DD-MM-YYYY');
    }


}
