<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\DepartmentDataTable;
use App\Http\Requests\Administration;
use App\Http\Requests\Administration\CreateDepartmentRequest;
use App\Http\Requests\Administration\UpdateDepartmentRequest;
use App\Repositories\Administration\DepartmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DepartmentController extends AppBaseController
{
    /** @var  DepartmentRepository */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the Department.
     *
     * @param DepartmentDataTable $departmentDataTable
     * @return Response
     */
    public function index(DepartmentDataTable $departmentDataTable)
    {
        return $departmentDataTable->render('administration.departments.index');
    }

    /**
     * Show the form for creating a new Department.
     *
     * @return Response
     */
    public function create()
    {
        $parents = $this->departmentRepository->model()::pluck('department_name', 'id')->prepend('self',0);
        return view('administration.departments.create')->with('parents', $parents);
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param CreateDepartmentRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $input = $request->all();

        $department = $this->departmentRepository->create($input);

        Flash::success('Department saved successfully.');

        return redirect(route('administration.departments.index'));
    }

    /**
     * Display the specified Department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('administration.departments.index'));
        }

        return view('administration.departments.show')->with('department', $department);
    }

    /**
     * Show the form for editing the specified Department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $department = $this->departmentRepository->find($id);
        $parents = $this->departmentRepository->model()::pluck('department_name', 'id')->prepend('self',0);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('administration.departments.index'));
        }

        return view('administration.departments.edit')
            ->with('department', $department)
            ->with('parents', $parents)
            ;
    }

    /**
     * Update the specified Department in storage.
     *
     * @param  int              $id
     * @param UpdateDepartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartmentRequest $request)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('administration.departments.index'));
        }

        $department = $this->departmentRepository->update($request->all(), $id);

        Flash::success('Department updated successfully.');

        return redirect(route('administration.departments.index'));
    }

    /**
     * Remove the specified Department from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('administration.departments.index'));
        }

        $this->departmentRepository->delete($id);

        Flash::success('Department deleted successfully.');

        return redirect(route('administration.departments.index'));
    }
}
