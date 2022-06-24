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
        Schema::create('wus_puses', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->string("wuspus_id")->nullable();
            $table->string("couple_id")->nullable();
            $table->string("status_kk")->nullable();
            $table->string("klp_dawasima")->nullable();
            $table->string("alive")->nullable();
            $table->string("death")->nullable();
            $table->integer("size")->nullable();
            $table->string("immune1")->nullable();
            $table->string("immune2")->nullable();
            $table->string("immune3")->nullable();
            $table->string("immune4")->nullable();
            $table->string("immune5")->nullable();
            $table->string("contraception_type")->nullable();
            $table->string("contraception_date")->nullable();
            $table->string("jkn")->nullable();
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
        Schema::dropIfExists('wus_puses');
    }
};
