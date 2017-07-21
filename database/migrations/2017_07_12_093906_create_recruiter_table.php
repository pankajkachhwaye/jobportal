<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruiterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organisation_name');
            $table->string('recruiter_email',100)->unique();
            $table->string('recruiter_mobile_no',100)->unique();
            $table->string('password');
            $table->tinyInteger('recruiter_profile_update')->default(false);
            $table->tinyInteger('recruiter_verified')->default(false); // this column will be a TINYINT with a default value of 0 , [0 for false & 1 for true i.e. verified]
            $table->string('token')->nullable(); // this column will be a VARCHAR with no default value and will also BE NULLABLE
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
        Schema::dropIfExists('recruiter');
    }
}
