<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\HolidayDataTable;
use App\Http\Requests\Administration;
use App\Http\Requests\Administration\CreateHolidayRequest;
use App\Http\Requests\Administration\UpdateHolidayRequest;
use App\Repositories\Administration\HolidayRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class HolidayController extends AppBaseController
{
    /** @var  HolidayRepository */
    private $holidayRepository;

    public function __construct(HolidayRepository $holidayRepo)
    {
        $this->holidayRepository = $holidayRepo;
    }

    /**
     * Display a listing of the Holiday.
     *
     * @param HolidayDataTable $holidayDataTable
     * @return Response
     */
    public function index(HolidayDataTable $holidayDataTable)
    {
        return $holidayDataTable->render('administration.holidays.index');
    }

    /**
     * Show the form for creating a new Holiday.
     *
     * @return Response
     */
    public function create()
    {
        return view('administration.holidays.create');
    }

    /**
     * Store a newly created Holiday in storage.
     *
     * @param CreateHolidayRequest $request
     *
     * @return Response
     */
    public function store(CreateHolidayRequest $request)
    {
        $input = $request->all();

        $holiday = $this->holidayRepository->create($input);

        Flash::success('Holiday saved successfully.');

        return redirect(route('administration.holidays.index'));
    }

    /**
     * Display the specified Holiday.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(route('administration.holidays.index'));
        }

        return view('administration.holidays.show')->with('holiday', $holiday);
    }

    /**
     * Show the form for editing the specified Holiday.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(route('administration.holidays.index'));
        }

        return view('administration.holidays.edit')->with('holiday', $holiday);
    }

    /**
     * Update the specified Holiday in storage.
     *
     * @param  int              $id
     * @param UpdateHolidayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHolidayRequest $request)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(route('administration.holidays.index'));
        }

        $holiday = $this->holidayRepository->update($request->all(), $id);

        Flash::success('Holiday updated successfully.');

        return redirect(route('administration.holidays.index'));
    }

    /**
     * Remove the specified Holiday from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(route('administration.holidays.index'));
        }

        $this->holidayRepository->delete($id);

        Flash::success('Holiday deleted successfully.');

        return redirect(route('administration.holidays.index'));
    }
}
