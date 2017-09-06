<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvtarToSeekerProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seeker_profile', function (Blueprint $table) {
            $table->text('avtar')->after('gender');
            $table->text('resume')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seeker_profile', function (Blueprint $table) {
            $table->dropColumn('avtar');
            $table->dropColumn('resume');

        });
    }
}
