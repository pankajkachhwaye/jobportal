<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeviceInfoToRecruiterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruiter', function (Blueprint $table) {
            $table->text('device_id')->nullable();
            $table->text('device_token')->nullable();
            $table->string('device_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruiter', function (Blueprint $table) {
          $table->dropColumn('device_id');
          $table->dropColumn('device_token');
          $table->dropColumn('device_type');
        });
    }
}
