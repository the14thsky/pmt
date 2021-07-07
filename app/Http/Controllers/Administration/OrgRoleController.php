<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\OrgRoleDataTable;
use App\Http\Requests\Administration;
use App\Http\Requests\Administration\CreateOrgRoleRequest;
use App\Http\Requests\Administration\UpdateOrgRoleRequest;
use App\Repositories\Administration\OrgRoleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OrgRoleController extends AppBaseController
{
    /** @var  OrgRoleRepository */
    private $orgRoleRepository;

    public function __construct(OrgRoleRepository $orgRoleRepo)
    {
        $this->orgRoleRepository = $orgRoleRepo;
    }

    /**
     * Display a listing of the OrgRole.
     *
     * @param OrgRoleDataTable $orgRoleDataTable
     * @return Response
     */
    public function index(OrgRoleDataTable $orgRoleDataTable)
    {
        return $orgRoleDataTable->render('administration.org_roles.index');
    }

    /**
     * Show the form for creating a new OrgRole.
     *
     * @return Response
     */
    public function create()
    {
        return view('administration.org_roles.create');
    }

    /**
     * Store a newly created OrgRole in storage.
     *
     * @param CreateOrgRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateOrgRoleRequest $request)
    {
        $input = $request->all();

        $orgRole = $this->orgRoleRepository->create($input);

        Flash::success('Org Role saved successfully.');

        return redirect(route('administration.orgRoles.index'));
    }

    /**
     * Display the specified OrgRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            Flash::error('Org Role not found');

            return redirect(route('administration.orgRoles.index'));
        }

        return view('administration.org_roles.show')->with('orgRole', $orgRole);
    }

    /**
     * Show the form for editing the specified OrgRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            Flash::error('Org Role not found');

            return redirect(route('administration.orgRoles.index'));
        }

        return view('administration.org_roles.edit')->with('orgRole', $orgRole);
    }

    /**
     * Update the specified OrgRole in storage.
     *
     * @param  int              $id
     * @param UpdateOrgRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrgRoleRequest $request)
    {
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            Flash::error('Org Role not found');

            return redirect(route('administration.orgRoles.index'));
        }

        $orgRole = $this->orgRoleRepository->update($request->all(), $id);

        Flash::success('Org Role updated successfully.');

        return redirect(route('administration.orgRoles.index'));
    }

    /**
     * Remove the specified OrgRole from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            Flash::error('Org Role not found');

            return redirect(route('administration.orgRoles.index'));
        }

        $this->orgRoleRepository->delete($id);

        Flash::success('Org Role deleted successfully.');

        return redirect(route('administration.orgRoles.index'));
    }
}
