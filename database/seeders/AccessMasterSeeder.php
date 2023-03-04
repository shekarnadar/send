<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccessMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['access_name'=>'product_add'],
            ['access_name'=>'product_update'],
            ['access_name'=>'product_delete'],
        ];
        \App\Models\AccessMaster::insert($data);
    }
}
