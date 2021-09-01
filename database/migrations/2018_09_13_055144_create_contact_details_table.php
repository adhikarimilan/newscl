<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('headertext')->nullable();
            $table->string('siteTitle')->nullable();
            $table->string('sitelogo')->nullable();
            $table->string('e_email')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('e_contactNumber')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('e_mobile')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('facebookUrl')->nullable();
            $table->string('twitterUrl')->nullable();
            $table->string('instagramUrl')->nullable();
            $table->string('googleUrl')->nullable();
            $table->string('footertext')->nullable();
            $table->mediumText('footertextdesc')->nullable();
            $table->string('footersidelinktitle')->nullable();
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
        Schema::dropIfExists('contact_details');
    }
}

