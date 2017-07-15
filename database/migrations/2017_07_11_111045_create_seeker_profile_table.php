<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeker_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seeker_id')->unsigned();
            $table->foreign('seeker_id')->references('id')->on('seeker')->onUpdate('cascade')->onDelete('cascade');
            $table->string('gender');
            $table->string('current_address');
            $table->integer('preferred_location');
            $table->integer('job_type')->nullable()->unsigned();
            $table->foreign('job_type')->references('id')->on('job_types');
            $table->integer('seeker_qualification')->nullable()->unsigned();
            $table->foreign('seeker_qualification')->references('id')->on('qualifications');
            $table->string('year_of_passing')->nullable();
            $table->string('percentage_or_cgpa')->nullable();
            $table->integer('area_of_sector')->nullable()->unsigned();
            $table->foreign('area_of_sector')->references('id')->on('area_of_sectors');
            $table->string('work_experience')->nullable();
            $table->string('experience_in_year')->nullable();
            $table->string('experience_in_months')->nullable();
            $table->integer('specialization')->nullable()->unsigned();
            $table->foreign('specialization')->references('id')->on('specializations');
            $table->integer('role_type')->nullable()->unsigned();
            $table->foreign('role_type')->references('id')->on('job_by_roles');
            $table->string('certification')->nullable();
            $table->string('resume')->nullable();
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
        Schema::dropIfExists('seeker_profile');
    }
}
