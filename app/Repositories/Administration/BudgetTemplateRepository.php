<?php

namespace App\Repositories\Administration;

use App\Models\Administration\BudgetTemplate;
use App\Repositories\BaseRepository;

/**
 * Class BudgetTemplateRepository
 * @package App\Repositories\Administration
 * @version November 18, 2020, 4:14 am UTC
*/

class BudgetTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'template_name',
        'description',
        'budgets'
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
        return BudgetTemplate::class;
    }
}
