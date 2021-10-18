<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MhParticipantTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mh_participant_types')->insert([
            'name' => "Panitia",
            'details' => "tipe panitia",
            "template" => ""
        ]);

        DB::table('mh_participant_types')->insert([
            'name' => "Tamu",
            'details' => "tipe Tamu",
            "template" => ""
        ]);

        DB::table('mh_participant_types')->insert([
            'name' => "Peserta",
            'details' => "tipe Peserta",
            "template" => ""
        ]);
    }
}
