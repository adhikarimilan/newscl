<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('bio')->nullable();
            $table->tinyInteger('gender');
            $table->integer('roll_no')->nullable();
            $table->string('per_address');
            $table->string('temp_address');
            $table->string('faculty')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('active')->default('0');
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->nullable()->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
