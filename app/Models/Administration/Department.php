<?php

namespace App\Models\Administration;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 * @package App\Models\Administration
 * @version November 6, 2020, 4:50 am UTC
 *
 * @property \App\Models\Administration\Department $department
 * @property string $department_name
 * @property integer $parent
 */
class Department extends Model
{
    use SoftDeletes;

    public $table = 'departments';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'department_name',
        'parent'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'department_name' => 'string',
        'parent' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_name' => 'required',
        'parent' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function department()
    {
        return $this->hasOne(\App\Models\Administration\Department::class, 'id', 'parent')->withDefault(['department_name'=>'Self']);
    }
}
