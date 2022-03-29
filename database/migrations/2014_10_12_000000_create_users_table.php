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
            $table->string("username")->unique();
            $table->string('name');
            $table->text("address")->nullable();
            $table->string("phone")->nullable();
            $table->string('email')->nullable();            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum("not_active", ["0", "1"]);
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
