<?php

namespace App\Models\Sales;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Customer
 * @package App\Models\Administration
 * @version November 10, 2020, 2:43 am UTC
 *
 * @property \App\Models\Administration\App\Models\Country $app\Models\Country
 * @property \App\Models\Administration\App\Models\Industry $app\Models\Industry
 * @property string $company_name
 * @property string $comp_code
 * @property string $company_address
 * @property integer $country_id
 * @property integer $industry_id
 */
class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'company_name',
        'comp_code',
        'company_address',
        'country_id',
        'industry_id',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_name' => 'string',
        'comp_code' => 'string',
        'country_id' => 'integer',
        'industry_id' => 'integer',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_name' => 'required',
        'comp_code' => 'required',
        'company_address' => 'required',
        'country_id' => 'required',
        'industry_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function Country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function Industry()
    {
        return $this->belongsTo(\App\Models\Industry::class);
    }
}
