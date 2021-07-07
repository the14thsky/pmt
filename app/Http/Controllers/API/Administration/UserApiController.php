<?php

namespace App\Http\Controllers\API\Administration;


use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Response;
use Illuminate\Support\Facades\Hash;
/**
 * Class UserAPIController
 * @package App\Http\Controllers\API\Administration
 */

class UserApiController extends AppBaseController
{


    /**
     * Display a listing of the users.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($users->toArray(), 'users retrieved successfully');
    }

    /**
     * Store a newly created user in storage.
     * POST /users
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();

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

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $user = User::find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function update($id, CreateUserRequest $request)
    {
        $input = $request->all();


        $user =User::find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = User::find($id)->update($input);
        $user->tokens()->delete();
        $user->remember_token = $user->createToken('api_token',$request->roles)->plainTextToken;
        $user->save();
        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified BudgetTemplate from storage.
     * DELETE /budgetTemplates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return $this->sendError('User not found');


        }

        User::find($id)->delete();
        $user->tokens()->delete();

        return $this->sendSuccess('User deleted successfully');
    }
}
