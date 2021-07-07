<?php

namespace App\Models\Sales;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Opportunity
 * @package App\Models\Sales
 * @version November 10, 2020, 3:28 am UTC
 *
 * @property \App\Models\Sales\\App\Models\Sales\Customer $\App\Models\Sales\Customer
 * @property integer $customer_id
 * @property string $contact_person_name
 * @property string $contact_person_email
 * @property string $contact_person_phone
 * @property string $opportunity_description
 * @property string $detailed_requirement
 * @property string $estimated_budget
 * @property string $chances
 * @property string $status
 * @property string $remarks
 */
class Opportunity extends Model
{
    use SoftDeletes;

    public $table = 'opportunities';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'customer_id',
        'title',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone',
        'contact_person_remarks',
        'opportunity_description',
        'detailed_requirement',
        'estimated_budget',
        'chances',
        'status',
        'remarks',
        'reason_loosing_bid',
        'total_award_value',
        'po_number',
        'po_date',
        'po_attachment',
        'invoicing_instruction',
        'payment_milestones',
        'project_budget',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'customer_id' => 'integer',
        'contact_person_name' => 'json',
        'contact_person_email' => 'json',
        'contact_person_phone' => 'json',
        'contact_person_remarks' => 'json',
        'detailed_requirement' => 'string',
        'estimated_budget' => 'string',
        'chances' => 'string',
        'status' => 'string',
        'reason_loosing_bid' => 'string',
        'total_award_value' => 'string',
        'po_number' => 'string',
        'po_attachment' => 'string',
        'invoicing_instruction' => 'string',
        'payment_milestones' => 'json',
        'project_budget' => 'json'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required',
        'title' => 'required',
        'contact_person_name' => 'required',
        'contact_person_email' => 'required',
        'contact_person_phone' => 'required',
        'opportunity_description' => 'required',
        'estimated_budget' => 'required',
        'chances' => 'required',
        'status' => 'required',
        'remarks' => 'required',
        'reason_loosing_bid' => 'sometimes|required_if:status,Closed',
        'total_award_value' => 'sometimes|required_if:status,Awarded',
        'po_number' => 'sometimes|required_if:status,Awarded',
        'po_date' => 'sometimes|required_if:status,Awarded',
        'po_attachment' => 'sometimes|required_if:status,Awarded',
        'invoicing_instruction' => 'sometimes|required_if:status,Awarded',
        'payment_milestones' => 'sometimes|required_if:status,Awarded',
        'project_budget' => 'sometimes|required_if:status,Awarded',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function Customer()
    {
        return $this->belongsTo(\App\Models\Sales\Customer::class);
    }

    public function setPoDateAttribute($value){
        $value ? $this->attributes['po_date']=Carbon::parse($value) : '';
    }

    public function getPoDateAttribute(){
        return $this->attributes['po_date'] ? Carbon::parse($this->attributes['po_date'])->isoFormat('DD-MM-YYYY') : '';
    }
}
