<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFillToBedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bed', function (Blueprint $table) {
            $table->string('user_id')->after('person');
            $table->string('bed_id')->nullable()->after('user_id');
            $table->string('status')->after('bed_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bed', function (Blueprint $table) {
            //
        });
    }
}
