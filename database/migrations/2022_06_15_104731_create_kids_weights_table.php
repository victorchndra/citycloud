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
        Schema::create('kids_weights', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('citizen_id')->nullable();
            $table->string('nik')->nullable();
            $table->string('name')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('head_width')->nullable();
            $table->string('imdb')->nullable();
            $table->string('method_measure')->nullable();
            $table->string('vitamin')->nullable();
            $table->string('kms')->nullable();
            $table->string('imunitation')->nullable();
            $table->string('booster')->nullable();
            $table->string('e1')->nullable();
            $table->string('e2')->nullable();
            $table->string('e3')->nullable();
            $table->string('e4')->nullable();
            $table->string('e5')->nullable();
            $table->string('e6')->nullable();
            $table->string('notes')->nullable();
            $table->date('imunitation_date')->nullable();
            
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
        Schema::dropIfExists('kids_weights');
    }
};
