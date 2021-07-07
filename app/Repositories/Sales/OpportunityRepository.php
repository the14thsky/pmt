<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Opportunity;
use App\Repositories\BaseRepository;

/**
 * Class OpportunityRepository
 * @package App\Repositories\Sales
 * @version November 10, 2020, 3:28 am UTC
*/

class OpportunityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone',
        'opportunity_description',
        'detailed_requirement',
        'estimated_budget',
        'chances',
        'status',
        'remarks'
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
        return Opportunity::class;
    }
}
