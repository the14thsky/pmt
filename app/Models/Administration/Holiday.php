<?php

namespace App\Models\Administration;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Holiday
 * @package App\Models\Administration
 * @version December 22, 2020, 5:21 pm UTC
 *
 * @property string $name
 * @property string $date
 */
class Holiday extends Model
{
    use SoftDeletes;

    public $table = 'holidays';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'date' => 'required'
    ];


    public function setDateAttribute($value){
        $value ? $this->attributes['date'] = Carbon::parse($value) : '';
    }

    public function getDateAttribute(){
        return  $this->attributes['date'] ? Carbon::parse($this->attributes['date'])->isoFormat('DD-MM-YYYY') : '';
    }
}
