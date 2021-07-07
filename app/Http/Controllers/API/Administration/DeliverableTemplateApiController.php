<?php

namespace App\Http\Controllers\API\Administration;


use Illuminate\Http\Request;
use App\Repositories\Administration\DeliverableTemplateRepository;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DeliverableTemplateAPIController
 * @package App\Http\Controllers\API\Administration
 */

class DeliverableTemplateApiController extends AppBaseController
{
    private $deliverableTemplateRepository;

    public function __construct(DeliverableTemplateRepository $deliverableTemplateRepo)
    {
        $this->deliverableTemplateRepository = $deliverableTemplateRepo;

    }

    /**
     * Display the specified DeliverableTemplate.
     * GET|HEAD /deliverableTemplates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DeliverableTemplate $deliverableTemplate */
        $deliverableTemplate = $this->deliverableTemplateRepository->find($id);

        if (empty($deliverableTemplate)) {
            return $this->sendError('Deliverable Template not found');
        }

        return $this->sendResponse($deliverableTemplate->toArray(), 'Deliverable Template retrieved successfully');
    }

}
