<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Deliverable;
use App\Repositories\BaseRepository;

/**
 * Class DeliverableRepository
 * @package App\Repositories\Sales
 * @version November 19, 2020, 2:56 am UTC
*/

class DeliverableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'project_id',
        'title',
        'deliverables'
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
        return Deliverable::class;
    }
}
