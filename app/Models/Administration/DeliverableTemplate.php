<?php

namespace App\Models\Administration;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeliverableTemplate
 * @package App\Models\Administration
 * @version December 16, 2020, 2:59 am UTC
 *
 * @property string $template_name
 * @property string $description
 * @property string $deliverables
 */
class DeliverableTemplate extends Model
{
    use SoftDeletes;

    public $table = 'deliverable_templates';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'template_name',
        'description',
        'deliverables'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'template_name' => 'string',
        'description' => 'string',
        'deliverables' => 'json'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'template_name' => 'required|string|max:255',
        'description' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
