<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\Sales\DeliverableDataTable;
use App\Http\Requests\Sales;
use App\Http\Requests\Sales\CreateDeliverableRequest;
use App\Http\Requests\Sales\UpdateDeliverableRequest;
use App\Repositories\Sales\DeliverableRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Administration\DeliverableTemplate;
use App\Models\Sales\Opportunity;
use App\Models\Sales\Project;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Response;

class DeliverableController extends AppBaseController
{
    /** @var  DeliverableRepository */
    private $deliverableRepository;

    public function __construct(DeliverableRepository $deliverableRepo)
    {
        $this->deliverableRepository = $deliverableRepo;
    }

    /**
     * Display a listing of the Deliverable.
     *
     * @param DeliverableDataTable $deliverableDataTable
     * @return Response
     */
    public function index(DeliverableDataTable $deliverableDataTable)
    {
        return $deliverableDataTable->render('sales.deliverables.index');
    }

    /**
     * Show the form for creating a new Deliverable.
     *
     * @return Response
     */
    public function create($opportunity_id=null)
    {

        if($opportunity_id){
            $budget_groups =Opportunity::find($opportunity_id)->project_budget['budget_group'];
            $project_id = Project::whereOpportunityId($opportunity_id)->first()->id;
            $templates = DeliverableTemplate::all()->pluck('template_name', 'id');

        }
        return view('sales.deliverables.create')
            ->with('project_id', $project_id)
            ->with('budget_groups', $budget_groups)
            ->with('templates', $templates)
        ;
    }

    /**
     * Store a newly created Deliverable in storage.
     *
     * @param CreateDeliverableRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliverableRequest $request)
    {
        $input = $request->all();
        $project_id = $request->project_id;
        //dd($input);
        foreach($input['deliverables']['task'] as $index=>$task){
            if($task!=='' && $task!==null){
                $this->deliverableRepository->create([
                    'project_id' => $project_id,
                    'title' => $input['title'],
                    'task' => $input['deliverables']['task'][$index],
                    'party' => $input['deliverables']['party'][$index],
                    'predecessor' => $input['deliverables']['predecessor'][$index],
                    'budget_group' => $input['deliverables']['budget_group'][$index],
                    'duration' => $input['deliverables']['duration'][$index],
                    'start_date' => Carbon::parse($input['deliverables']['start_date'][$index]),
                    'end_date' => Carbon::parse($input['deliverables']['end_date'][$index]),
                    'status' => $input['deliverables']['status'][$index],
                    'man_hours' => $input['deliverables']['man_hours'][$index]==null? 0 : +$input['deliverables']['man_hours'][$index]
                ]);
            }
        }


        Flash::success('Deliverable saved successfully.');

        return redirect(route('sales.deliverables.index'));
    }

    /**
     * Display the specified Deliverable.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            Flash::error('Deliverable not found');

            return redirect(route('sales.deliverables.index'));
        }

        return view('sales.deliverables.show')->with('deliverable', $deliverable);
    }

    /**
     * Show the form for editing the specified Deliverable.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            Flash::error('Deliverable not found');

            return redirect(route('sales.deliverables.index'));
        }

            $budget_groups =Opportunity::find($deliverable->project_id)->project_budget['budget_group'];
            $templates = DeliverableTemplate::all()->pluck('template_name', 'id');


        return view('sales.deliverables.edit')
            ->with('deliverable', $deliverable)
            ->with('budget_groups', $budget_groups)
            ->with('templates', $templates)
        ;
    }

    /**
     * Update the specified Deliverable in storage.
     *
     * @param  int              $id
     * @param UpdateDeliverableRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliverableRequest $request)
    {
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            Flash::error('Deliverable not found');

            return redirect(route('sales.deliverables.index'));
        }
        //dd($request->all());
        $deliverable = $this->deliverableRepository->update($request->all(), $id);

        Flash::success('Deliverable updated successfully.');

        return redirect(route('sales.deliverables.index'));
    }

    /**
     * Remove the specified Deliverable from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            Flash::error('Deliverable not found');

            return redirect(route('sales.deliverables.index'));
        }

        $this->deliverableRepository->delete($id);

        Flash::success('Deliverable deleted successfully.');

        return redirect(route('sales.deliverables.index'));
    }
}
