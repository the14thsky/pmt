<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\DeliverableTemplateDataTable;
use App\Http\Requests\Administration;
use App\Http\Requests\Administration\CreateDeliverableTemplateRequest;
use App\Http\Requests\Administration\UpdateDeliverableTemplateRequest;
use App\Repositories\Administration\DeliverableTemplateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use stdClass;

class DeliverableTemplateController extends AppBaseController
{
    /** @var  DeliverableTemplateRepository */
    private $deliverableTemplateRepository;

    public function __construct(DeliverableTemplateRepository $deliverableTemplateRepo)
    {
        $this->deliverableTemplateRepository = $deliverableTemplateRepo;
    }

    /**
     * Display a listing of the DeliverableTemplate.
     *
     * @param DeliverableTemplateDataTable $deliverableTemplateDataTable
     * @return Response
     */
    public function index(DeliverableTemplateDataTable $deliverableTemplateDataTable)
    {
        return $deliverableTemplateDataTable->render('administration.deliverable_templates.index');
    }

    /**
     * Show the form for creating a new DeliverableTemplate.
     *
     * @return Response
     */
    public function create()
    {
        $deliverable = new stdClass();
        $deliverable->task='';
        $deliverable->party='';
        $deliverable->predecessor='';
        $deliverable->duration='';
        return view('administration.deliverable_templates.create')->with('deliverable', $deliverable);
    }

    /**
     * Store a newly created DeliverableTemplate in storage.
     *
     * @param CreateDeliverableTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliverableTemplateRequest $request)
    {
        $input = $request->all();

        $deliverableTemplate = $this->deliverableTemplateRepository->create($input);

        Flash::success('Deliverable Template saved successfully.');

        return redirect(route('administration.deliverableTemplates.index'));
    }

    /**
     * Display the specified DeliverableTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliverableTemplate = $this->deliverableTemplateRepository->find($id);

        if (empty($deliverableTemplate)) {
            Flash::error('Deliverable Template not found');

            return redirect(route('administration.deliverableTemplates.index'));
        }

        return view('administration.deliverable_templates.show')->with('deliverableTemplate', $deliverableTemplate);
    }

    /**
     * Show the form for editing the specified DeliverableTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliverableTemplate = $this->deliverableTemplateRepository->find($id);
        //dd($deliverableTemplate);
        if (empty($deliverableTemplate)) {
            Flash::error('Deliverable Template not found');

            return redirect(route('administration.deliverableTemplates.index'));
        }

        return view('administration.deliverable_templates.edit')->with('deliverableTemplate', $deliverableTemplate);
    }

    /**
     * Update the specified DeliverableTemplate in storage.
     *
     * @param  int              $id
     * @param UpdateDeliverableTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliverableTemplateRequest $request)
    {
        $deliverableTemplate = $this->deliverableTemplateRepository->find($id);

        if (empty($deliverableTemplate)) {
            Flash::error('Deliverable Template not found');

            return redirect(route('administration.deliverableTemplates.index'));
        }

        $deliverableTemplate = $this->deliverableTemplateRepository->update($request->all(), $id);

        Flash::success('Deliverable Template updated successfully.');

        return redirect(route('administration.deliverableTemplates.index'));
    }

    /**
     * Remove the specified DeliverableTemplate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliverableTemplate = $this->deliverableTemplateRepository->find($id);

        if (empty($deliverableTemplate)) {
            Flash::error('Deliverable Template not found');

            return redirect(route('administration.deliverableTemplates.index'));
        }

        $this->deliverableTemplateRepository->delete($id);

        Flash::success('Deliverable Template deleted successfully.');

        return redirect(route('administration.deliverableTemplates.index'));
    }
}
