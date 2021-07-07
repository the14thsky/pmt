<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\BudgetTemplateDataTable;
use App\Http\Requests\Administration;
use App\Http\Requests\Administration\CreateBudgetTemplateRequest;
use App\Http\Requests\Administration\UpdateBudgetTemplateRequest;
use App\Repositories\Administration\BudgetTemplateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BudgetTemplateController extends AppBaseController
{
    /** @var  BudgetTemplateRepository */
    private $budgetTemplateRepository;

    public function __construct(BudgetTemplateRepository $budgetTemplateRepo)
    {
        $this->budgetTemplateRepository = $budgetTemplateRepo;
    }

    /**
     * Display a listing of the BudgetTemplate.
     *
     * @param BudgetTemplateDataTable $budgetTemplateDataTable
     * @return Response
     */
    public function index(BudgetTemplateDataTable $budgetTemplateDataTable)
    {
        return $budgetTemplateDataTable->render('administration.budget_templates.index');
    }

    /**
     * Show the form for creating a new BudgetTemplate.
     *
     * @return Response
     */
    public function create()
    {
        return view('administration.budget_templates.create');
    }

    /**
     * Store a newly created BudgetTemplate in storage.
     *
     * @param CreateBudgetTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateBudgetTemplateRequest $request)
    {
        $input = $request->all();

        $budgetTemplate = $this->budgetTemplateRepository->create($input);

        Flash::success('Budget Template saved successfully.');

        return redirect(route('administration.budgetTemplates.index'));
    }

    /**
     * Display the specified BudgetTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            Flash::error('Budget Template not found');

            return redirect(route('administration.budgetTemplates.index'));
        }

        return view('administration.budget_templates.show')->with('budgetTemplate', $budgetTemplate);
    }

    /**
     * Show the form for editing the specified BudgetTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            Flash::error('Budget Template not found');

            return redirect(route('administration.budgetTemplates.index'));
        }

        return view('administration.budget_templates.edit')->with('budgetTemplate', $budgetTemplate);
    }

    /**
     * Update the specified BudgetTemplate in storage.
     *
     * @param  int              $id
     * @param UpdateBudgetTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBudgetTemplateRequest $request)
    {
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            Flash::error('Budget Template not found');

            return redirect(route('administration.budgetTemplates.index'));
        }

        $budgetTemplate = $this->budgetTemplateRepository->update($request->all(), $id);

        Flash::success('Budget Template updated successfully.');

        return redirect(route('administration.budgetTemplates.index'));
    }

    /**
     * Remove the specified BudgetTemplate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $budgetTemplate = $this->budgetTemplateRepository->find($id);

        if (empty($budgetTemplate)) {
            Flash::error('Budget Template not found');

            return redirect(route('administration.budgetTemplates.index'));
        }

        $this->budgetTemplateRepository->delete($id);

        Flash::success('Budget Template deleted successfully.');

        return redirect(route('administration.budgetTemplates.index'));
    }
}
