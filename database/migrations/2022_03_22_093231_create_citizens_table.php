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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->string('nik',16)->nullable();
            $table->string('kk',16)->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('family_status')->nullable();
            $table->string('blood')->nullable();
            $table->string('job')->nullable();
            $table->string('phone')->nullable();
            $table->string('marriage')->nullable();
            $table->string('last_education')->nullable();
            $table->string('vaccine_1')->nullable();
            $table->string('vaccine_2')->nullable();
            $table->string('vaccine_3')->nullable();
            $table->string('health_assurance')->nullable();
            $table->string('poor')->nullable();
            $table->string('move_to')->nullable();
            $table->date('move_date')->nullable();
            $table->date('death_date')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->string('sub_districts')->nullable();
            $table->string('districts')->nullable();
            $table->string('province')->nullable();
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
        Schema::dropIfExists('citizens');
    }
};
