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
        Schema::create('pregnant_mothers', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->integer("citizen_id")->nullable();
            $table->integer("weight")->nullable();
            $table->integer("height")->nullable();
            $table->string("pregnant_to")->nullable();
            $table->integer("gestational_age")->nullable();
            $table->string("disease")->nullable();
            $table->string("lila")->nullable();
            $table->string("check_pregnancy")->nullable();
            $table->string("number_lives")->nullable();
            $table->string("number_death")->nullable();
            $table->date("meninggal")->nullable();
            $table->string("tt1")->nullable();
            $table->string("tt2")->nullable();
            $table->string("tt3")->nullable();
            $table->string("tt4")->nullable();
            $table->string("tt5")->nullable();
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
        Schema::dropIfExists('pregnant_mothers');
    }
};
