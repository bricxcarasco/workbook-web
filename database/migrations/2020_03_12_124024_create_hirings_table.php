<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHiringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hirings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id');
            $table->integer('seeker_id');
            $table->string('interview_date');
            $table->string('interview_time');
            $table->string('interview_location');
            $table->string('contact_person');
            $table->integer('status');
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
        Schema::dropIfExists('hirings');
    }
}
