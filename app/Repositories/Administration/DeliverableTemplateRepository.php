<?php

namespace App\Repositories\Administration;

use App\Models\Administration\DeliverableTemplate;
use App\Repositories\BaseRepository;

/**
 * Class DeliverableTemplateRepository
 * @package App\Repositories\Administration
 * @version December 16, 2020, 2:59 am UTC
*/

class DeliverableTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'template_name',
        'description',
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
        return DeliverableTemplate::class;
    }
}
