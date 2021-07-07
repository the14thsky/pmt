<?php

use App\Models\Administration\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Department::insert([
            'department_name' => 'CEO Office',
            'parent' => 0
       ]);
    }
}
