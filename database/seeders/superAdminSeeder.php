<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class superAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions=config("permission");
        $role=role::create([

            "name"=>"super admin",
            "permissions"=>json_encode($permissions)
        ]);

        admin::create([
            "name"=>"ali hmaidi",
            "email"=>"alihmaidi095@gmail.com",
            "password"=>Hash::make("ali450892"),
            "role_id"=>$role->id            
        ]);

    }
}
