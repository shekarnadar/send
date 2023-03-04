<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['role_name'=>'super_admin'],
            ['role_name'=>'client_admin'],
            ['role_name'=>'manager'],
        ];
        \App\Models\RoleMaster::insert($data);        
    }
}
