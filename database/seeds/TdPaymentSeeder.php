<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TdPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('td_payments')->insert([
            'th_payment_id' => 1,
            "mh_participant_id" => 1
        ]);

        DB::table('td_payments')->insert([
            'th_payment_id' => 2,
            "mh_participant_id" => 2
        ]);

        DB::table('td_payments')->insert([
            'th_payment_id' => 3,
            "mh_participant_id" => 3
        ]);
    }
}
