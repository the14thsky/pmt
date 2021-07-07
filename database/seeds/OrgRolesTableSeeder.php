<?php

use App\Models\Administration\OrgRole;
use Illuminate\Database\Seeder;

class OrgRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       OrgRole::create([
           'role_name' => 'Senior Management'
       ]);
    }
}
