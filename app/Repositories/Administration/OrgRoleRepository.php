<?php

namespace App\Repositories\Administration;

use App\Models\Administration\OrgRole;
use App\Repositories\BaseRepository;

/**
 * Class OrgRoleRepository
 * @package App\Repositories\Administration
 * @version November 6, 2020, 3:35 am UTC
*/

class OrgRoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_name'
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
        return OrgRole::class;
    }
}
