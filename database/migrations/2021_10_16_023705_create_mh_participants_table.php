<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mh_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name", 150);
            $table->string("address", 150)->default("");
            $table->string("contact", 150)->default("");
            $table->bigInteger("payment")->default(0);
            $table->string("custom_title", 20)->nullable(); // mengganti title dari id card misalnya default sesuai tipe jika ada isi maka direplace dengan isi title berlaku untuk tamu
            $table->text("description");
            $table->string("key", 255)->default("");
            $table->integer("paid_status")->default(0);
            $table->integer("mh_participant_type_id")->index();
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
        Schema::dropIfExists('mh_participants');
    }
}
