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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->integer("citizens_id")->unique();
            $table->string("username")->unique();
            $table->string('name');
            $table->string('front_title');
            $table->string('back_title');
            $table->text("address")->nullable();
            $table->string("phone")->nullable();
            $table->string('email')->nullable();            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('roles');
            $table->string('avatar');
            $table->string('position');
            $table->string('apparatus');
            $table->enum("active", ["1", "0"]);
            $table->string('village_sub')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->string('sub_districts')->nullable();
            $table->string('districts')->nullable();
            $table->string('province')->nullable();
            $table->integer("created_by");
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
        Schema::dropIfExists('users');
    }
};
