<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruiterProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiter_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruiter_id')->unsigned();
            $table->foreign('recruiter_id')->references('id')->on('recruiter')->onUpdate('cascade')->onDelete('cascade');
            $table->string('i_am');
            $table->string('org_location');
            $table->string('org_address');
            $table->string('org_website')->nullable();
            $table->text('org_discription');
            $table->string('org_logo')->nullable();
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
        Schema::dropIfExists('recruiter_profile');
    }
}
