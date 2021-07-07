<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country
 * @package App\Models
 * @version November 10, 2020, 2:42 am UTC
 *
 * @property string $short_name
 * @property string $country_name
 */
class Country extends Model
{
    use SoftDeletes;

    public $table = 'countries';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'short_name',
        'country_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'short_name' => 'string',
        'country_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'short_name' => 'required|string|max:255',
        'country_name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
