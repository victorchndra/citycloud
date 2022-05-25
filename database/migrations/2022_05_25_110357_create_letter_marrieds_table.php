<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_marrieds', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('letter_index')->nullable();
            $table->string('letter_name')->nullable();
            $table->integer('citizen_id')->nullable();
            $table->string('nik')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('place_birth')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->string('village_sub')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->string('sub_districts')->nullable();
            $table->string('districts')->nullable();
            $table->string('province')->nullable();
            //////////////////////////////////////
            ///////////////data surat////////////////

            ////////////////////////////////////////
            ////////////////data wajib//////////////
            $table->string('signature')->nullable();
            $table->string('signed_by')->nullable();
            $table->date('letter_date')->nullable();
            $table->string('approval_rt')->nullable();
            $table->string('approval_admin')->nullable();
            $table->string('rejected_notes_admin')->nullable();
            $table->string('rejected_notes_rt')->nullable();
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
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
        Schema::dropIfExists('letter_marrieds');
    }
};
