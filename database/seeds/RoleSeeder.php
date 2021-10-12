<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "Admin",
            'detail' => "Role Admin",
        ]);

        DB::table('roles')->insert([
            'name' => "Manager",
            'detail' => "Role Manager",
        ]);

        DB::table('roles')->insert([
            'name' => "Cashier",
            'detail' => "Role Cashier",
        ]);

        DB::table('roles')->insert([
            'name' => "Inventory",
            'detail' => "Role Inventory",
        ]);
    }
}
