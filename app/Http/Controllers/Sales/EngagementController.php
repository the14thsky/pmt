<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\Sales\EngagementDataTable;
use App\Http\Requests\Sales;
use App\Http\Requests\Sales\CreateEngagementRequest;
use App\Http\Requests\Sales\UpdateEngagementRequest;
use App\Repositories\Sales\EngagementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Sales\Customer;
use App\Models\Sales\Opportunity;
use Illuminate\Support\Facades\Storage;
use Response;

class EngagementController extends AppBaseController
{
    /** @var  EngagementRepository */
    private $engagementRepository;

    public function __construct(EngagementRepository $engagementRepo)
    {
        $this->engagementRepository = $engagementRepo;
    }

    /**
     * Display a listing of the Engagement.
     *
     * @param EngagementDataTable $engagementDataTable
     * @return Response
     */
    public function index(EngagementDataTable $engagementDataTable)
    {
        return $engagementDataTable->render('sales.engagements.index');
    }

    /**
     * Show the form for creating a new Engagement.
     *
     * @return Response
     */
    public function create($id=null)
    {
        $customers = Customer::pluck('company_name','id');
        if($id==null){
            return view('sales.engagements.create')
            ->with('customers', $customers)
        ;
        }
        else{
            $opportunities = Opportunity::find($id);
            return view('sales.engagements.create')
            ->with('customers', $customers)
            ->with('opportunities', $opportunities)
        ;
        }

    }

    /**
     * Store a newly created Engagement in storage.
     *
     * @param CreateEngagementRequest $request
     *
     * @return Response
     */
    public function store(CreateEngagementRequest $request)
    {

        $input = $request->all();
        if(isset($request->id) && $request->id!==null){
            $opportunityId = $request->id;
            $input['opportunity_id'] = $opportunityId;
            $input['customer_id'] = Opportunity::find($opportunityId)->customer->id;
        }
        if($request->file('attachment')!==null) {
            $file = $request->file('attachment');
            $filename = \Ramsey\Uuid\Uuid::uuid1()->toString().".".$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('engagement',$file,$filename);
            $filepath = Storage::url('engagement/'.$filename);

            $input['attachment'] = $filepath;
        }
        $engagement = $this->engagementRepository->create($input);

        Flash::success('Engagement saved successfully.');

        return redirect(route('sales.opportunities.index'));
    }

    /**
     * Display the specified Engagement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $engagement = $this->engagementRepository->find($id);

        if (empty($engagement)) {
            Flash::error('Engagement not found');

            return redirect(route('sales.engagements.index'));
        }

        return view('sales.engagements.show')->with('engagement', $engagement);
    }

    /**
     * Show the form for editing the specified Engagement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $engagement = $this->engagementRepository->find($id);
        $customers = Customer::pluck('company_name','id');
        if (empty($engagement)) {
            Flash::error('Engagement not found');

            return redirect(route('sales.engagements.index'));
        }

        return view('sales.engagements.edit')
            ->with('engagement', $engagement)
            ->with('customers', $customers)
            ;
    }

    /**
     * Update the specified Engagement in storage.
     *
     * @param  int              $id
     * @param UpdateEngagementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEngagementRequest $request)
    {
        $engagement = $this->engagementRepository->find($id);

        $input = $request->all();
        if (empty($engagement)) {
            Flash::error('Engagement not found');

            return redirect(route('sales.engagements.index'));
        }

        if($request->file('attachment')!==null) {
            $file = $request->file('attachment');
            $filename = \Ramsey\Uuid\Uuid::uuid1()->toString().".".$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('engagement',$file,$filename);
            $filepath = Storage::url('engagement/'.$filename);

            $input['attachment'] = $filepath;
        }

        $engagement = $this->engagementRepository->update($input, $id);

        Flash::success('Engagement updated successfully.');

        return redirect(route('sales.opportunities.index'));
    }

    /**
     * Remove the specified Engagement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $engagement = $this->engagementRepository->find($id);

        if (empty($engagement)) {
            Flash::error('Engagement not found');

            return redirect(route('sales.engagements.index'));
        }

        $this->engagementRepository->delete($id);

        Flash::success('Engagement deleted successfully.');

        return redirect(route('sales.engagements.index'));
    }
}
