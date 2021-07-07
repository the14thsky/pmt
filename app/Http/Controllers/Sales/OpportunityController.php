<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\Sales\OpportunityDataTable;
use App\Http\Requests\Sales;
use App\Http\Requests\Sales\CreateOpportunityRequest;
use App\Http\Requests\Sales\UpdateOpportunityRequest;
use App\Repositories\Sales\OpportunityRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Administration\BudgetTemplate;
use App\Models\Administration\UserProject;
use App\Models\Sales\Customer;
use App\Models\Sales\Project;
use App\Models\Sales\ProjectMilestone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Response;
use Illuminate\Support\Facades\DB;

class OpportunityController extends AppBaseController
{
    /** @var  OpportunityRepository */
    private $opportunityRepository;

    public function __construct(OpportunityRepository $opportunityRepo)
    {
        $this->opportunityRepository = $opportunityRepo;
    }

    /**
     * Display a listing of the Opportunity.
     *
     * @param OpportunityDataTable $opportunityDataTable
     * @return Response
     */
    public function index(OpportunityDataTable $opportunityDataTable)
    {
        return $opportunityDataTable->render('sales.opportunities.index');
    }

    /**
     * Show the form for creating a new Opportunity.
     *
     * @return Response
     */
    public function create()
    {
        $companies =  Customer::pluck('company_name','id');


            return view('sales.opportunities.create')
             ->with('companies', $companies)
             ->with('budgets', $budgets=array())
        ;


    }

    /**
     * Store a newly created Opportunity in storage.
     *
     * @param CreateOpportunityRequest $request
     *
     * @return Response
     */
    public function store(CreateOpportunityRequest $request)
    {
        $input = $request->all();
        if($request->file('detailed_requirement')!==null) {
            $file = $request->file('detailed_requirement');
            $filename = \Ramsey\Uuid\Uuid::uuid1()->toString().".".$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('opportunity',$file,$filename);
            $filepath = Storage::url('opportunity/'.$filename);

            $input['detailed_requirement'] = $filepath;
        }

        if($request->file('po_attachment')!==null) {
            $file = $request->file('po_attachment');
            $filename = \Ramsey\Uuid\Uuid::uuid1()->toString().".".$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('po_attachment',$file,$filename);
            $filepath = Storage::url('po_attachment/'.$filename);

            $input['po_attachment'] = $filepath;
        }
        $input['created_by'] = Auth::user()->id;
        $opportunity = $this->opportunityRepository->create($input);

        Flash::success('Opportunity saved successfully.');

        return redirect(route('sales.opportunities.index'));
    }

    /**
     * Display the specified Opportunity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $opportunity = $this->opportunityRepository->find($id);

        if (empty($opportunity)) {
            Flash::error('Opportunity not found');

            return redirect(route('sales.opportunities.index'));
        }

        return view('sales.opportunities.show')->with('opportunity', $opportunity);
    }

    /**
     * Show the form for editing the specified Opportunity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id)
    {

        $opportunity = $this->opportunityRepository->find($id);

        if (empty($opportunity)) {
            Flash::error('Opportunity not found');

            return redirect(route('sales.opportunities.index'));
        }
        $budget = $request::query('budget');
        if($budget){
            $opportunity->project_budget = BudgetTemplate::find($budget)->budgets;
            $opportunity->status=='Published' || $opportunity->status=='Awarded' ? $opportunity->status=$opportunity->status : $opportunity->status='Awarded';
        }
        $companies =  Customer::pluck('company_name','id');
        $budgets = BudgetTemplate::pluck('template_name','id');
        $budgets->prepend('select');
        return view('sales.opportunities.edit')
        ->with('opportunity', $opportunity)
        ->with('companies', $companies)
        ->with('budgets', $budgets)
        ;
    }

    /**
     * Update the specified Opportunity in storage.
     *
     * @param  int              $id
     * @param UpdateOpportunityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOpportunityRequest $request)
    {

        $opportunity = $this->opportunityRepository->find($id);
        $input = $request->all();

        if (empty($opportunity)) {
            Flash::error('Opportunity not found');

            return redirect(route('sales.opportunities.index'));
        }
        if($request->file('detailed_requirement')!==null) {
            $file = $request->file('detailed_requirement');
            $filename = \Ramsey\Uuid\Uuid::uuid1()->toString().".".$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('opportunity',$file,$filename);
            $filepath = Storage::url('opportunity/'.$filename);

            $input['detailed_requirement'] = $filepath;
        }

        if($request->file('po_attachment')!==null) {
            $file = $request->file('po_attachment');
            $filename = \Ramsey\Uuid\Uuid::uuid1()->toString().".".$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('po_attachment',$file,$filename);
            $filepath = Storage::url('po_attachment/'.$filename);

            $input['po_attachment'] = $filepath;
        }

        if(isset($request->publish)){
            $input['status'] = 'Published';
        }
        DB::transaction(function () use($input,$id) {
        try {
            $opportunity = $this->opportunityRepository->update($input, $id);

        if($opportunity->status=='Published'){

                $project=  Project::UpdateOrCreate(['opportunity_id'=>$opportunity->id],[
                    'opportunity_id' => $opportunity->id,
                    'customer_id'   => $opportunity->customer_id,
                    'project_code'  => ProjectController::getProjCode($opportunity->customer_id, $opportunity->id),
                    'status'        => 1
                ]);

                ProjectMilestone::whereProjectId($project->id)->delete();

                foreach($opportunity['payment_milestones']['milestone'] as $index=>$milestone){

                    if($milestone){
                        ProjectMilestone::create([
                            'project_id' => $project->id,
                            'milestone' => $opportunity['payment_milestones']['milestone'][$index],
                            'percentage' => $opportunity['payment_milestones']['per_of_total'][$index],
                            'amount' => $opportunity['payment_milestones']['amount'][$index]
                        ]);
                    }

                }

                if(!in_array('superadmin', auth('sanctum')->user()->tokens->first()->abilities)){
                     UserProject::updateOrCreate(
                        ['project_id'=>$project->id, 'user_id'=>auth('sanctum')->user()->id],
                        ['project_id'=>$project->id, 'user_id'=>auth('sanctum')->user()->id]
                    );
                }


        }
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
         }

    });

        Flash::success('Opportunity updated successfully.');

        return redirect(route('sales.opportunities.index'));
    }

    /**
     * Remove the specified Opportunity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $opportunity = $this->opportunityRepository->find($id);

        if (empty($opportunity)) {
            Flash::error('Opportunity not found');

            return redirect(route('sales.opportunities.index'));
        }

        $this->opportunityRepository->delete($id);

        Flash::success('Opportunity deleted successfully.');

        return redirect(route('sales.opportunities.index'));
    }
}
