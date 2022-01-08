<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title');
            $table->string('gender');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('timezone');
            $table->string('timezone_description');
            $table->string('phone');
            $table->string('cell');
            $table->string('email');
            $table->string('username');
            $table->string('nat');
            $table->string("picture_large");
            $table->string("picture_medium");
            $table->string("picture_thumbnail");
            $table->timestamp('registered');
            $table->uuid('uuid');
            $table->timestamp('dob')->nullable();
            $table->timestamp('imported_t')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->enum('status', ["draft", "trash", "published"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
}
