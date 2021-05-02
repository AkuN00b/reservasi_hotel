<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFillInRoomNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_number', function (Blueprint $table) {
            $table->string('user_id')->after('status');
            $table->string('room_number_id')->nullable()->after('user_id');
            $table->string('req_status')->nullable()->after('room_number_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_number', function (Blueprint $table) {
            //
        });
    }
}
