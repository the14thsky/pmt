<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Administration\Department;
use App\Models\Administration\OrgRole;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

/**
     * Display a listing of the Department.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $departments = Department::pluck('department_name','id');
        $org_roles = OrgRole::pluck('role_name', 'id');
        return view('users.create')
            ->with('departments', $departments)
            ->with('orgRoles', $org_roles)
        ;
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();
        //dd($data);
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'org_role_id' => $data['org_role_id'],
            'department_id' => $data['department_id'],
            'is_2fa' => isset($data['is_2fa'])?1:0,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date']
        ]);

        $user->remember_token = $user->createToken('api_token',$data['roles'])->plainTextToken;
        $user->save();


        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles=$user->tokens()->first()->abilities;
        $departments = Department::pluck('department_name','id');
        $org_roles = OrgRole::pluck('role_name', 'id');

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')
            ->with('departments', $departments)
            ->with('orgRoles', $org_roles)
            ->with('user', $user)
            ->with('roles', $roles)
            ;
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);
         if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->except('password'), $id);
        $user->tokens()->delete();
        $user->remember_token = $user->createToken('api_token',$request->roles)->plainTextToken;
        $user->save();
        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);
        $user->tokens()->delete();
        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
