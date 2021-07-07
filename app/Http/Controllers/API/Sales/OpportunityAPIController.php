<?php

namespace App\Http\Controllers\API\Sales;

use App\Http\Requests\API\Sales\CreateOpportunityAPIRequest;
use App\Http\Requests\API\Sales\UpdateOpportunityAPIRequest;
use App\Models\Sales\Opportunity;
use App\Repositories\Sales\OpportunityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OpportunityController
 * @package App\Http\Controllers\API\Sales
 */

class OpportunityAPIController extends AppBaseController
{
    /** @var  OpportunityRepository */
    private $opportunityRepository;

    public function __construct(OpportunityRepository $opportunityRepo)
    {
        $this->opportunityRepository = $opportunityRepo;
    }

    /**
     * Display a listing of the Opportunity.
     * GET|HEAD /opportunities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $opportunities = $this->opportunityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($opportunities->toArray(), 'Opportunities retrieved successfully');
    }

    /**
     * Store a newly created Opportunity in storage.
     * POST /opportunities
     *
     * @param CreateOpportunityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOpportunityAPIRequest $request)
    {
        $input = $request->all();

        $opportunity = $this->opportunityRepository->create($input);

        return $this->sendResponse($opportunity->toArray(), 'Opportunity saved successfully');
    }

    /**
     * Display the specified Opportunity.
     * GET|HEAD /opportunities/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Opportunity $opportunity */
        $opportunity = $this->opportunityRepository->find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        return $this->sendResponse($opportunity->toArray(), 'Opportunity retrieved successfully');
    }

    /**
     * Update the specified Opportunity in storage.
     * PUT/PATCH /opportunities/{id}
     *
     * @param int $id
     * @param UpdateOpportunityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOpportunityAPIRequest $request)
    {
        $input = $request->all();

        /** @var Opportunity $opportunity */
        $opportunity = $this->opportunityRepository->find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        $opportunity = $this->opportunityRepository->update($input, $id);

        return $this->sendResponse($opportunity->toArray(), 'Opportunity updated successfully');
    }

    /**
     * Remove the specified Opportunity from storage.
     * DELETE /opportunities/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Opportunity $opportunity */
        $opportunity = $this->opportunityRepository->find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        $opportunity->delete();

        return $this->sendSuccess('Opportunity deleted successfully');
    }
}
