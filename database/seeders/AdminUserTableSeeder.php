<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'first_name' => 'Admin',
            'last_name' => 'Steven',            
            'email' => 'admin@mailinator.com',
            'password' => bcrypt(123456),
            'phone' => '+91987654321',
            'role_master_id' => 1,
        ]);
    }
}
