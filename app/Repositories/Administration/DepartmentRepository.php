<?php

namespace App\Repositories\Administration;

use App\Models\Administration\Department;
use App\Repositories\BaseRepository;

/**
 * Class DepartmentRepository
 * @package App\Repositories\Administration
 * @version November 6, 2020, 4:50 am UTC
*/

class DepartmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'department_name',
        'parent'
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
        return Department::class;
    }
}
