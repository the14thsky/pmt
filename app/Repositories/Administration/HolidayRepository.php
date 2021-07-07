<?php

namespace App\Repositories\Administration;

use App\Models\Administration\Holiday;
use App\Repositories\BaseRepository;

/**
 * Class HolidayRepository
 * @package App\Repositories\Administration
 * @version December 22, 2020, 5:21 pm UTC
*/

class HolidayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'date'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Holiday::class;
    }
}
