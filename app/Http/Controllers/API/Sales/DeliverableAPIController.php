<?php

namespace App\Http\Controllers\API\Sales;

use App\Http\Requests\API\Sales\CreateDeliverableAPIRequest;
use App\Http\Requests\API\Sales\UpdateDeliverableAPIRequest;
use App\Models\Sales\Deliverable;
use App\Repositories\Sales\DeliverableRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Sales\TimeCharging;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\DB;
/**
 * Class DeliverableController
 * @package App\Http\Controllers\API\Sales
 */

class DeliverableAPIController extends AppBaseController
{
    /** @var  DeliverableRepository */
    private $deliverableRepository;

    public function __construct(DeliverableRepository $deliverableRepo)
    {
        $this->deliverableRepository = $deliverableRepo;
    }

    /**
     * Display a listing of the Deliverable.
     * GET|HEAD /deliverables
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $deliverables = $this->deliverableRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($deliverables->toArray(), 'Deliverables retrieved successfully');
    }

    /**
     * Store a newly created Deliverable in storage.
     * POST /deliverables
     *
     * @param CreateDeliverableAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliverableAPIRequest $request)
    {
        $input = $request->all();

        $deliverable = $this->deliverableRepository->create($input);

        return $this->sendResponse($deliverable->toArray(), 'Deliverable saved successfully');
    }

    /**
     * Display the specified Deliverable.
     * GET|HEAD /deliverables/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Deliverable $deliverable */
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            return $this->sendError('Deliverable not found');
        }

        return $this->sendResponse($deliverable->toArray(), 'Deliverable retrieved successfully');
    }

    /**
     * Update the specified Deliverable in storage.
     * PUT/PATCH /deliverables/{id}
     *
     * @param int $id
     * @param UpdateDeliverableAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliverableAPIRequest $request)
    {
        $input = $request->all();

        /** @var Deliverable $deliverable */
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            return $this->sendError('Deliverable not found');
        }

        $deliverable = $this->deliverableRepository->update($input, $id);

        return $this->sendResponse($deliverable->toArray(), 'Deliverable updated successfully');
    }

    /**
     * Remove the specified Deliverable from storage.
     * DELETE /deliverables/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Deliverable $deliverable */
        $deliverable = $this->deliverableRepository->find($id);

        if (empty($deliverable)) {
            return $this->sendError('Deliverable not found');
        }

        $deliverable->delete();

        return $this->sendSuccess('Deliverable deleted successfully');
    }

    public function getDeliverables($projectID){
        $deliverables = $this->deliverableRepository->model()::where('project_id', $projectID)->get();
        return $this->sendResponse($deliverables->toArray(), 'Deliverable retrieved successfully');
    }

    public function updateDeliverable($id, Request $request){

        $id = +explode('-',$id)[1];
        $input = $request->all();
        try {
        $this->deliverableRepository->update([
            'start_date' => Carbon::createFromTimestampMs($input['data']['time']['start'])->addDay(1),
            'end_date' => Carbon::createFromTimestampMs($input['data']['time']['end'])->addDay(1)
        ], $id);




            return $this->sendSuccess('Deliverable updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }

    }
    public function getDeliverablesByTitle($projectId, $deliverableTitle){
        $deliverables = $this->deliverableRepository->model()::where('project_id', $projectId)->where('title', $deliverableTitle)->get();
        return $this->sendResponse($deliverables->toArray(), 'Deliverable retrieved successfully');
    }

    public function getTimeChargeByUser(Request $request){
        $deliverableIds = $request->deliverableIds;
        $date = Carbon::parse($request->date)->toDateString();
        $timechargings = TimeCharging::with('deliverable')->whereIn('deliverable_id', $deliverableIds)->whereUpdatedBy(auth('sanctum')->user()->id)->whereDate('created_at',$date)->get();
        return $this->sendResponse($timechargings->toArray(), 'time charging retrieved successfully');
    }

    public function updateTimeCharge(Request $request){
        $deliverables = $request->deliverables;
        $timeCharges = $request->time_charges;
        $date = Carbon::parse($request->date)->toDateString();

        DB::transaction(function () use($timeCharges, $date, $deliverables) {
            foreach($timeCharges as $time_charge){
                TimeCharging::updateOrCreate([
                    'project_id'=>$time_charge['project_id'],
                    'deliverable_id'=>$time_charge['deliverable_id'],
                    'created_at' => TimeCharging::where('created_at', '>', $date)->first()->created_at ?? null,
                    'updated_by' => auth('sanctum')->user()->id
                ],[
                    'project_id'=>$time_charge['project_id'],
                    'deliverable_id'=>$time_charge['deliverable_id'],
                    'man_hour' => +$time_charge['man_hour'],
                    'updated_by' => auth('sanctum')->user()->id
                ]);


            }

            foreach($deliverables as $deliverable){
                $man_hours = TimeCharging::where('deliverable_id',$deliverable['id'])->sum('man_hour');
                if($man_hours>0){
                    Deliverable::find($deliverable['id'])->update([
                        'man_hours' => $man_hours,
                        'status' => $deliverable['status']=='Completed' ? 'Completed' : 'Started'
                    ]);
                }
            }
        });


        return $this->sendResponse('Success', 'time charging saved successfully');

    }
}
