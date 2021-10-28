<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mh_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->dateTime("start_at");
            $table->string("location");
            $table->text("description");
            $table->boolean("is_open")->default(0);
            $table->string("key", 255);
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
        Schema::dropIfExists('mh_events');
    }
}
