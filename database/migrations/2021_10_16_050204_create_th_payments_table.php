<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('th_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger("type");
            $table->string("bank", 100)->nullable();
            $table->string("account", 100)->nullable();
            $table->bigInteger("total");
            $table->string("file", 255)->nullable();
            $table->text("detail");
            $table->bigInteger("user_id")->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('th_payments');
    }
}
