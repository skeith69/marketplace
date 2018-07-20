<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin Role'
        ]);

        DB::table('roles')->insert([
            'name' => 'tenant',
            'display_name' => 'Tenant',
            'description' => 'Tenant Role'
        ]);

        DB::table('admins')->insert([
            'name' => 'Marketplace Admin',
            'email' => 'admin@marketplace.com',
            'password' => bcrypt('123456')
        ]);

        DB::table('admin_role')->insert([
            'admin_id' => 1,
            'role_id' => 1
        ]);
    }
}
