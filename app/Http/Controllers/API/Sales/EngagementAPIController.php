<?php

namespace App\Http\Controllers\API\Sales;

use App\Http\Requests\API\Sales\CreateEngagementAPIRequest;
use App\Http\Requests\API\Sales\UpdateEngagementAPIRequest;
use App\Models\Sales\Engagement;
use App\Repositories\Sales\EngagementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EngagementController
 * @package App\Http\Controllers\API\Sales
 */

class EngagementAPIController extends AppBaseController
{
    /** @var  EngagementRepository */
    private $engagementRepository;

    public function __construct(EngagementRepository $engagementRepo)
    {
        $this->engagementRepository = $engagementRepo;
    }

    /**
     * Display a listing of the Engagement.
     * GET|HEAD /engagements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $engagements = $this->engagementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($engagements->toArray(), 'Engagements retrieved successfully');
    }

    /**
     * Store a newly created Engagement in storage.
     * POST /engagements
     *
     * @param CreateEngagementAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEngagementAPIRequest $request)
    {
        $input = $request->all();

        $engagement = $this->engagementRepository->create($input);

        return $this->sendResponse($engagement->toArray(), 'Engagement saved successfully');
    }

    /**
     * Display the specified Engagement.
     * GET|HEAD /engagements/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Engagement $engagement */
        $engagement = $this->engagementRepository->find($id);

        if (empty($engagement)) {
            return $this->sendError('Engagement not found');
        }

        return $this->sendResponse($engagement->toArray(), 'Engagement retrieved successfully');
    }

    /**
     * Update the specified Engagement in storage.
     * PUT/PATCH /engagements/{id}
     *
     * @param int $id
     * @param UpdateEngagementAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEngagementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Engagement $engagement */
        $engagement = $this->engagementRepository->find($id);

        if (empty($engagement)) {
            return $this->sendError('Engagement not found');
        }

        $engagement = $this->engagementRepository->update($input, $id);

        return $this->sendResponse($engagement->toArray(), 'Engagement updated successfully');
    }

    /**
     * Remove the specified Engagement from storage.
     * DELETE /engagements/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Engagement $engagement */
        $engagement = $this->engagementRepository->find($id);

        if (empty($engagement)) {
            return $this->sendError('Engagement not found');
        }

        $engagement->delete();

        return $this->sendSuccess('Engagement deleted successfully');
    }
}
