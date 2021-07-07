<?php

namespace App\Http\Controllers\API\Administration;

use App\Http\Requests\API\Administration\CreateBudgetTemplateAPIRequest;
use App\Http\Requests\API\Administration\UpdateBudgetTemplateAPIRequest;
use App\Models\Administration\BudgetTemplate;
use App\Repositories\Administration\BudgetTemplateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BudgetTemplateController
 * @package App\Http\Controllers\API\Administration
 */

class BudgetTemplateAPIController extends AppBaseController
{
    /** @var  BudgetTemplateRepository */
    private $budgetTemplateRepository;

    public function __construct(BudgetTemplateRepository $budgetTemplateRepo)
    {
        $this->budgetTemplateRepository = $budgetTemplateRepo;
    }

    /**
     * Display a listing of the BudgetTemplate.
     * GET|HEAD /budgetTemplates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $budgetTemplates = $this->budgetTemplateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($budgetTemplates->toArray(), 'Budget Templates retrieved successfully');
    }

    /**
     * Store a newly created BudgetTemplate in storage.
     * POST /budgetTemplates
     *
     * @param CreateBudgetTemplateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBudgetTemplateAPIRequest $request)
    {
        $input = $request->all();

        $budgetTemplate = $this->budgetTemplateRepository->create($input);

        return $this->sendResponse($budgetTemplate->toArray(), 'Budget Template saved successfully');
    }

    /**
     * Display the specified BudgetTemplate.
     * GET|HEAD /budgetTemplates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var BudgetTemplate $budgetTemplate */
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            return $this->sendError('Budget Template not found');
        }

        return $this->sendResponse($budgetTemplate->toArray(), 'Budget Template retrieved successfully');
    }

    /**
     * Update the specified BudgetTemplate in storage.
     * PUT/PATCH /budgetTemplates/{id}
     *
     * @param int $id
     * @param UpdateBudgetTemplateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBudgetTemplateAPIRequest $request)
    {
        $input = $request->all();

        /** @var BudgetTemplate $budgetTemplate */
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            return $this->sendError('Budget Template not found');
        }

        $budgetTemplate = $this->budgetTemplateRepository->update($input, $id);

        return $this->sendResponse($budgetTemplate->toArray(), 'BudgetTemplate updated successfully');
    }

    /**
     * Remove the specified BudgetTemplate from storage.
     * DELETE /budgetTemplates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var BudgetTemplate $budgetTemplate */
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            return $this->sendError('Budget Template not found');
        }

        $budgetTemplate->delete();

        return $this->sendSuccess('Budget Template deleted successfully');
    }
}
