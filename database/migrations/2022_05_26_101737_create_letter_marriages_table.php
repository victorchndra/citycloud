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
            
            $table->string('yesnoAyah',10)->nullable();
            $table->integer('father_id')->nullable();
            $table->string('father_name',30)->nullable();
            $table->string('father_bin')->nullable();
            $table->string('father_nik',20)->nullable();
            $table->string('father_place_birth',20)->nullable();
            $table->date('father_date_birth')->nullable();
            $table->string('father_citizenship',10)->nullable();
            $table->string('father_religion',20)->nullable();
            $table->string('father_job',20)->nullable();
            $table->string('father_address',30)->nullable();

            $table->string('yesnoIbu',10)->nullable();
            $table->integer('mother_id')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_bin')->nullable();
            $table->string('mother_nik',30)->nullable();
            $table->string('mother_place_birth',20)->nullable();
            $table->date('mother_date_birth')->nullable();
            $table->string('mother_citizenship',10)->nullable();
            $table->string('mother_religion',10)->nullable();
            $table->string('mother_job',20)->nullable();
            $table->string('mother_address',30)->nullable();

            $table->string('yesnoCalon',10)->nullable();
            $table->integer('couple_id')->nullable();
            $table->string('couple_name')->nullable();
            $table->string('couple_bin')->nullable();
            $table->string('couple_nik',30)->nullable();
            $table->string('couple_place_birth',30)->nullable();
            $table->date('couple_date_birth')->nullable();
            $table->string('couple_citizenship',10)->nullable();
            $table->string('couple_religion',10)->nullable();
            $table->string('couple_job',20)->nullable();
            $table->string('couple_address',30)->nullable();

            $table->date('marriage_date')->nullable();
            $table->string('dowry')->nullable();

            $table->string('yesnoPindah',10)->nullable();
            $table->string('letter_index_move',30)->nullable();
            $table->string('move_village',30)->nullable();
            $table->string('move_sub_districts',30)->nullable();
            $table->string('move_districts',30)->nullable();
            $table->string('move_province',30)->nullable();

            $table->string('yesnoMeninggal',10)->nullable();
            $table->string('letter_index_death',30)->nullable();
            $table->date('death_date')->nullable();
            $table->string('death_location',30)->nullable();

            $table->string('yesnoMantan',10)->nullable();
            $table->string('ex_id')->nullable();
            $table->string('ex_name')->nullable();
            $table->string('ex_nik',30)->nullable();
            $table->string('ex_place_birth',30)->nullable();
            $table->date('ex_date_birth')->nullable();
            $table->string('ex_citizenship',10)->nullable();
            $table->string('ex_religion',10)->nullable();
            $table->string('ex_job',20)->nullable();
            $table->string('ex_address',30)->nullable();

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
