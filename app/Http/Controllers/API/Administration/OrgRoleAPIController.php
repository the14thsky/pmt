<?php

namespace App\Http\Controllers\API\Administration;

use App\Http\Requests\API\Administration\CreateOrgRoleAPIRequest;
use App\Http\Requests\API\Administration\UpdateOrgRoleAPIRequest;
use App\Models\Administration\OrgRole;
use App\Repositories\Administration\OrgRoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrgRoleController
 * @package App\Http\Controllers\API\Administration
 */

class OrgRoleAPIController extends AppBaseController
{
    /** @var  OrgRoleRepository */
    private $orgRoleRepository;

    public function __construct(OrgRoleRepository $orgRoleRepo)
    {
        $this->orgRoleRepository = $orgRoleRepo;
    }

    /**
     * Display a listing of the OrgRole.
     * GET|HEAD /orgRoles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orgRoles = $this->orgRoleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orgRoles->toArray(), 'Org Roles retrieved successfully');
    }

    /**
     * Store a newly created OrgRole in storage.
     * POST /orgRoles
     *
     * @param CreateOrgRoleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrgRoleAPIRequest $request)
    {
        $input = $request->all();

        $orgRole = $this->orgRoleRepository->create($input);

        return $this->sendResponse($orgRole->toArray(), 'Org Role saved successfully');
    }

    /**
     * Display the specified OrgRole.
     * GET|HEAD /orgRoles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrgRole $orgRole */
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            return $this->sendError('Org Role not found');
        }

        return $this->sendResponse($orgRole->toArray(), 'Org Role retrieved successfully');
    }

    /**
     * Update the specified OrgRole in storage.
     * PUT/PATCH /orgRoles/{id}
     *
     * @param int $id
     * @param UpdateOrgRoleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrgRoleAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrgRole $orgRole */
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            return $this->sendError('Org Role not found');
        }

        $orgRole = $this->orgRoleRepository->update($input, $id);

        return $this->sendResponse($orgRole->toArray(), 'OrgRole updated successfully');
    }

    /**
     * Remove the specified OrgRole from storage.
     * DELETE /orgRoles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrgRole $orgRole */
        $orgRole = $this->orgRoleRepository->find($id);

        if (empty($orgRole)) {
            return $this->sendError('Org Role not found');
        }

        $orgRole->delete();

        return $this->sendSuccess('Org Role deleted successfully');
    }
}
