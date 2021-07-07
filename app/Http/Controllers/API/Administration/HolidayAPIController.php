<?php

namespace App\Http\Controllers\API\Administration;

use App\Http\Requests\API\Administration\CreateHolidayAPIRequest;
use App\Http\Requests\API\Administration\UpdateHolidayAPIRequest;
use App\Models\Administration\Holiday;
use App\Repositories\Administration\HolidayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use DateTime;
use Response;

/**
 * Class HolidayController
 * @package App\Http\Controllers\API\Administration
 */

class HolidayAPIController extends AppBaseController
{
    /** @var  HolidayRepository */
    private $holidayRepository;

    public function __construct(HolidayRepository $holidayRepo)
    {
        $this->holidayRepository = $holidayRepo;
    }

    /**
     * Display a listing of the Holiday.
     * GET|HEAD /holidays
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $holidays = $this->holidayRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($holidays->toArray(), 'Holidays retrieved successfully');
    }

    /**
     * Store a newly created Holiday in storage.
     * POST /holidays
     *
     * @param CreateHolidayAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHolidayAPIRequest $request)
    {
        $input = $request->all();

        $holiday = $this->holidayRepository->create($input);

        return $this->sendResponse($holiday->toArray(), 'Holiday saved successfully');
    }

    /**
     * Display the specified Holiday.
     * GET|HEAD /holidays/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Holiday $holiday */
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            return $this->sendError('Holiday not found');
        }

        return $this->sendResponse($holiday->toArray(), 'Holiday retrieved successfully');
    }

    /**
     * Update the specified Holiday in storage.
     * PUT/PATCH /holidays/{id}
     *
     * @param int $id
     * @param UpdateHolidayAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHolidayAPIRequest $request)
    {
        $input = $request->all();

        /** @var Holiday $holiday */
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            return $this->sendError('Holiday not found');
        }

        $holiday = $this->holidayRepository->update($input, $id);

        return $this->sendResponse($holiday->toArray(), 'Holiday updated successfully');
    }

    /**
     * Remove the specified Holiday from storage.
     * DELETE /holidays/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Holiday $holiday */
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            return $this->sendError('Holiday not found');
        }

        $holiday->delete();

        return $this->sendSuccess('Holiday deleted successfully');
    }

    public function countHolidays(Request $request){
        $duration =$request->duration;
        $days = 0;
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->start_date)->addDays($duration);

        do {
            $holidays = $this->holidayRepository->model()::whereBetween('date', [$start_date, $end_date]);
            $days = $days+$this->number_of_working_dates($start_date, $end_date, $holidays->pluck('date'));
            $end_date = Carbon::parse($end_date)->addDays($duration-$days);
        } while ($duration >$days);


        $response = ['days'=>$days];
        return $this->sendResponse($response, 'success');
    }

    function number_of_working_dates($startDate, $endDate, $holidays) {

        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);

        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        //It will return 1 if it's Monday,.. ,7 for Sunday
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);

        //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
        //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if ($the_first_day_of_week <= $the_last_day_of_week) {
        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        }
        else {


        // the day of the week for start is later than the day of the week for end
        if ($the_first_day_of_week == 7) {
        // if the start date is a Sunday, then we definitely subtract 1 day
        $no_remaining_days--;

        if ($the_last_day_of_week == 6) {
        // if the end date is a Saturday, then we subtract another day
        $no_remaining_days--;
        }
        }
        else {
        // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
        // so we skip an entire weekend and subtract 2 days
        $no_remaining_days -= 2;
        }
        }

        //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
        //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
        $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0 )
        {
        $workingDays += $no_remaining_days;
        }

        //We subtract the holidays
        foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        //If the holiday doesn't fall in weekend
        if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
        $workingDays--;
        }

        return $workingDays-1;
    }
}
