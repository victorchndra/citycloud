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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('letter_index')->nullable();
            $table->string('village_name')->nullable();
            $table->string('sub_district_name')->nullable();
            $table->string('district_name')->nullable();
            $table->string('province_name')->nullable();
            $table->string('header')->nullable();
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('information');
    }
};
