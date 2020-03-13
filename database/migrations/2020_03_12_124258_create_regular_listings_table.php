<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('dti_permit')->nullable();
            $table->string('title')->nullable();
            $table->string('details')->nullable();
            $table->string('tags')->nullable();
            $table->integer('type');
            $table->string('min_offer')->nullable();
            $table->string('max_offer')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality')->nullable();
            $table->string('postal')->nullable();
            $table->integer('slots');
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
        Schema::dropIfExists('regular_listings');
    }
}
