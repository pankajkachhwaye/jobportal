<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruiter_id')->unsigned();
            $table->foreign('recruiter_id')->references('id')->on('recruiter')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('job_type')->unsigned();
            $table->foreign('job_type')->references('id')->on('job_types');
            $table->integer('job_by_roles')->unsigned();
            $table->foreign('job_by_roles')->references('id')->on('job_by_roles');
            $table->integer('qualification')->unsigned();
            $table->foreign('qualification')->references('id')->on('qualifications');
            $table->integer('job_location')->unsigned();
            $table->foreign('job_location')->references('id')->on('location');
            $table->string('year_of_passing')->nullable();
            $table->string('percentage_or_cgpa')->nullable();
            $table->integer('specialization')->unsigned();
            $table->foreign('specialization')->references('id')->on('specializations');
            $table->string('experience');
            $table->text('job_discription');
            $table->string('min_sal');
            $table->string('max_sal');
            $table->string('per');
            $table->string('vacancies');
            $table->date('last_date');
            $table->text('process');
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
        Schema::dropIfExists('jobs');
    }
}
