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
        Schema::create('letter_marriages', function (Blueprint $table) {
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
            $table->string('marriage_status')->nullable();
            $table->string('ex_name')->nullable();
            
            $table->string('father_option')->nullable();
            $table->integer('father_id')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_bin')->nullable();
            $table->string('father_nik')->nullable();
            $table->string('father_place_birth')->nullable();
            $table->date('father_date_birth')->nullable();
            $table->string('father_citizenship')->nullable();
            $table->string('father_religion')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_address')->nullable();


            $table->string('mother_option')->nullable();
            $table->integer('mother_id')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_bin')->nullable();
            $table->string('mother_nik')->nullable();
            $table->string('mother_place_birth')->nullable();
            $table->date('mother_date_birth')->nullable();
            $table->string('mother_citizenship')->nullable();
            $table->string('mother_religion')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_address')->nullable();

            $table->string('couple_option')->nullable();
            $table->integer('couple_id')->nullable();
            $table->string('couple_name')->nullable();
            $table->string('couple_bin')->nullable();
            $table->string('couple_nik')->nullable();
            $table->string('couple_place_birth')->nullable();
            $table->date('couple_date_birth')->nullable();
            $table->string('couple_citizenship')->nullable();
            $table->string('couple_religion')->nullable();
            $table->string('couple_job')->nullable();
            $table->string('couple_address')->nullable();

            $table->date('marriage_date')->nullable();
            $table->string('dowry')->nullable();

            $table->string('move_option')->nullable();
            $table->string('no_recomendation')->nullable();

            $table->string('move_village')->nullable();
            $table->string('move_sub_districts')->nullable();
            $table->string('move_sub_districts')->nullable();
            $table->string('move_districts')->nullable();
            $table->string('move_province')->nullable();


            $table->string('death_option')->nullable();
            $table->string('death_no')->nullable();
            $table->date('death_date')->nullable();
            $table->string('death_location')->nullable();

            $table->string('ex_option')->nullable();
            $table->string('ex_id')->nullable();
            $table->string('ex_name')->nullable();
            $table->string('ex_nik')->nullable();
            $table->string('ex_place_birth')->nullable();
            $table->date('ex_date_birth')->nullable();
            $table->string('ex_citizenship')->nullable();
            $table->string('ex_religion')->nullable();
            $table->string('ex_job')->nullable();
            $table->string('ex_address')->nullable();

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
        Schema::dropIfExists('letter_marriages');
    }
};
