<?php

namespace App\Models\Administration;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Administration/UserProject
 * @package App\Models
 * @version May 5, 2021, 7:13 am UTC
 *
 */
class UserProject extends Model
{
    use SoftDeletes;

    public $table = 'user_projects';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'project_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
