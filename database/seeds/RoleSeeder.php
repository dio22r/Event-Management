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
            'name' => "Registration",
            'detail' => "Role Registration",
        ]);

        DB::table('roles')->insert([
            'name' => "Payment",
            'detail' => "Role Payment",
        ]);

        DB::table('roles')->insert([
            'name' => "Acomodation",
            'detail' => "Role Acomodation",
        ]);
    }
}
