<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('th_payments')->insert([
            'type' => 1,
            'detail' => "Pembayaran untuk Bla.. Bla..",
            "total" => 500000,
            "user_id" => 1
        ]);

        DB::table('th_payments')->insert([
            'type' => 2,
            'detail' => "Pembayaran ke 2 untuk Bla.. Bla..",
            "total" => 500000,
            "user_id" => 5
        ]);

        DB::table('th_payments')->insert([
            'type' => 1,
            'detail' => "Pembayaran ke 3 untuk Bla.. Bla..",
            "total" => 500000,
            "user_id" => 5
        ]);
    }
}
