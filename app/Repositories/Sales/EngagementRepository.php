<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Engagement;
use App\Repositories\BaseRepository;

/**
 * Class EngagementRepository
 * @package App\Repositories\Sales
 * @version November 12, 2020, 3:08 am UTC
*/

class EngagementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'opportunity_id',
        'type',
        'brief_description',
        'attachment',
        'follow_up',
        'action_item',
        'dateline'
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
        return Engagement::class;
    }
}
