<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuebooks', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->boolean('isteacher')->default(false);
            $table->boolean('returned')->default(false);
            $table->bigInteger('book_id')->unsigned()->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->date('issued_at');
            $table->date('return_bef');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issuebooks');
    }
}
