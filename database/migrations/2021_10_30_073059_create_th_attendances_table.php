<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('th_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mh_event_id');
            $table->bigInteger('mh_participant_id');
            $table->integer('status_log'); // 1 masuk, 2 keluar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('th_attendances');
    }
}
