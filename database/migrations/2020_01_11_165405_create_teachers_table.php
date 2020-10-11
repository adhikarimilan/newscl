<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('bio')->nullable();
            $table->tinyInteger('gender');
            $table->string('per_address');
            $table->string('temp_address');
            $table->string('education')->nullable();
            $table->string('faculty')->nullable();
            $table->string('avatar')->nullable();
            $table->string('post')->nullable();
            $table->string('type')->nullable();
            $table->boolean('active')->default('0');
            $table->string('email')->unique();
            $table->string('contact')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('order')->unsigned()->default(30);
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
        Schema::dropIfExists('teachers');
    }
}
