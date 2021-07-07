<?php

namespace App\Models\Administration;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrgRole
 * @package App\Models\Administration
 * @version November 6, 2020, 3:35 am UTC
 *
 * @property string $role_name
 */
class OrgRole extends Model
{
    use SoftDeletes;

    public $table = 'org_roles';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
