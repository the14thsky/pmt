<?php

use App\Http\Controllers\API\Administration\UserApiController;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = new CreateUserRequest([
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'email' => 'admin@test.com',
            'password' => '123456',
            'org_role_id' => 1,
            'department_id' => 1,
            'is_2fa' => true,
            'roles' => ["superadmin","super_project_admin","project","super_sales_admin","sales","finance","staff"],
            'start_date' => '01-01-2021',
            'end_date' => '01-01-2029'
        ]);


        $userApi = new UserApiController();
        $userApi->store($userData);
    }
}
