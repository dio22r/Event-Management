<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThAccomodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('th_accomodations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("location");
            $table->string("room");
            $table->date("check_in")->nullable();
            $table->date("check_out")->nullable();
            $table->bigInteger("user_id")->index();
            $table->softDeletes();
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
        Schema::dropIfExists('th_accomodations');
    }
}
