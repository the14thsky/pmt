<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\Sales\AssignDataTable;
use App\DataTables\Sales\ProjectDataTable;
use App\Http\Requests\Sales;
use App\Http\Requests\Sales\CreateProjectRequest;
use App\Http\Requests\Sales\UpdateProjectRequest;
use App\Repositories\Sales\ProjectRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Administration\UserProject;
use App\Models\Sales\Customer;
use App\Models\Sales\Project;
use App\Models\Sales\ProjectMilestone;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Response;

class ProjectController extends AppBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the Project.
     *
     * @param ProjectDataTable $projectDataTable
     * @return Response
     */
    public function index(ProjectDataTable $projectDataTable)
    {
        return $projectDataTable->render('sales.projects.index');
    }

    /**
     * Show the form for creating a new Project.
     *
     * @return Response
     */
    public function create()
    {
        return view('sales.projects.create');
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        $project = $this->projectRepository->create($input);

        Flash::success('Project saved successfully.');

        return redirect(route('sales.projects.index'));
    }

    /**
     * Display the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->find($id);
        $project->deliverable = $project->deliverable->groupBy('title')->all();
        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('sales.projects.index'));
        }

        return view('sales.projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('sales.projects.index'));
        }

        return view('sales.projects.edit')->with('project', $project);
    }

    /**
     * Update the specified Project in storage.
     *
     * @param  int              $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('sales.projects.index'));
        }

        $project = $this->projectRepository->update($request->all(), $id);

        Flash::success('Project updated successfully.');

        return redirect(route('sales.projects.index'));
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('sales.projects.index'));
        }

        $this->projectRepository->delete($id);

        Flash::success('Project deleted successfully.');

        return redirect(route('sales.projects.index'));
    }

    public static function getProjCode($custId, $opportunity_id){
       $count = Project::where('customer_id', $custId)->where('opportunity_id','!=',$opportunity_id)->count();
       //dd($count);
       $code = Customer::find($custId)->comp_code;
       $count = $count+1;
       return $code.'_Proj'.$count;
    }

    public function assign(AssignDataTable $assignDataTable, $projId)
    {
        $users = UserProject::whereProjectId($projId)->get()->pluck('user_id')->toArray();

        return $assignDataTable->with('users', $users)->render('sales.projects.assign', ['projId'=>$projId]);
    }

    public function assignUsers(Request $request, $projId){
        $input= $request->all();
        $input['users'] = array_map('intval', $input['users']);
        $assigned = UserProject::whereProjectId($projId)->get()->pluck('user_id')->toArray();
        if($assigned){
            $unassigned = array_diff($assigned,$input['users']);
            if($unassigned){
                foreach($unassigned as $unassign){
                    UserProject::whereUserId($unassign)->whereProjectId($projId)->delete();
                }
            }

        }
        foreach($input['users'] as $user){
            UserProject::updateOrCreate(
                ['project_id'=>$projId, 'user_id'=>$user],
                ['project_id'=>$projId, 'user_id'=>$user]
            );
        }

        Flash::success('Project assigned successfully.');

        return redirect(route('sales.projects.index'));

    }

    public function milestones($id){
        $milestones = ProjectMilestone::whereProjectId($id)->get();
        $comp_name = $this->projectRepository->model()::with('customer')->whereId($id)->first()->customer->company_name;
        $comp_code = $this->projectRepository->model()::with('customer')->whereId($id)->first()->customer->comp_code;
        $role = in_array('finance', auth('sanctum')->user()->tokens->first()->abilities) ? 'Finance' : 'Non-Finance';
        return view('sales.projects.milestone')
            ->with('milestones', $milestones)
            ->with('comp_code', $comp_code)
            ->with('company_name', $comp_name)
            ->with('role', $role)
            ;
    }

    public function updateMilestone(Request $request){
        $input = $request->all();
        foreach($input['milestones'] as $milestone){
            ProjectMilestone::updateOrCreate(['id'=>$milestone['id'], 'project_id'=>$milestone['project_id']],
            $milestone);
        }
    }

    public function timecharge($id){
        $project = $this->projectRepository->find($id);
        $deliverables = $this->projectRepository->find($id)->deliverable->groupBy('title');

        $deliverable_list = [];
        foreach($deliverables as $deliverable){

            array_push($deliverable_list,[
                'id' => $deliverable[0]['id'],
                'value' => $deliverable[0]['title'],
                'name' => $project->project_code.'-'.$deliverable[0]['title']
            ]);



        }

        return view('sales.projects.timecharge')
            ->with('deliverable_list', $deliverable_list)
            ->with('projId', $id)
        ;
    }
}
