<?php

namespace App\Models\Administration;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BudgetTemplate
 * @package App\Models\Administration
 * @version November 18, 2020, 4:14 am UTC
 *
 * @property string $template_name
 * @property string $description
 * @property string $budgets
 */
class BudgetTemplate extends Model
{
    use SoftDeletes;

    public $table = 'budget_templates';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'template_name',
        'description',
        'budgets'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'template_name' => 'string',
        'budgets' => 'json'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'template_name' => 'required',
        'description' => 'required',
        'budgets' => 'required'
    ];


}
